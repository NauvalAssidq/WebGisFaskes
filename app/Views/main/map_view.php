<!-- Map View Component -->
<div id="map" class="border border-gray-400 rounded"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([5.5483, 95.3238], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: 'Map data © OpenStreetMap contributors'
    }).addTo(map);

    let markers = [];

    function clearMarkers() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
    }

    function loadMarkers() {
    const keyword = document.getElementById('searchInput').value;
    const amenity = document.getElementById('amenityFilter').value;

    fetch(`/map/getMarkers?search=${encodeURIComponent(keyword)}&amenity=${encodeURIComponent(amenity)}`)
        .then(res => res.json())
        .then(data => {
        clearMarkers();

        data.forEach(item => {
            const marker = L.marker([item.lat, item.lng]).addTo(map);
            marker.bindTooltip(item.amenity, { direction: 'top' });
            marker.bindPopup(`<strong>${item.name}</strong><br>${item.amenity}`);
            markers.push(marker);
        });
        });
    }

    function loadAmenityOptions() {
    fetch('/map/getAmenitiesList')
        .then(res => res.json())
        .then(options => {
        const select = document.getElementById('amenityFilter');
        options.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item;
            opt.textContent = item;
            select.appendChild(opt);
        });
        });
    }

    loadAmenityOptions();
    loadMarkers();
</script>