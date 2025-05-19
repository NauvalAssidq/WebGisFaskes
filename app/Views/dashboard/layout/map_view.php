<!-- Map View Component -->
<div id="map" class="border border-gray-400 rounded h-[600px]"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const mapGetMarkersURL = "<?= base_url('dashboard/map/getMarkers') ?>";
    const mapAmenitiesListURL = "<?= base_url('dashboard/map/getAmenitiesList') ?>";

    const bandaAcehBounds = L.latLngBounds(
        L.latLng(5.40, 95.20),
        L.latLng(5.70, 95.45)
    );

    const map = L.map('map', {
        maxBounds: bandaAcehBounds,
        maxBoundsViscosity: 1.0,
        minZoom: 12,
        maxZoom: 18
    }).setView([5.5483, 95.3238], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '',
        maxZoom: 18,
        minZoom: 12
    }).addTo(map);

    let markers = [];

    function clearMarkers() {
        markers.forEach(m => map.removeLayer(m));
        markers = [];
    }

    let maxFilters = 3;

    function addAmenityFilter() {
        const container = document.getElementById('amenityFiltersContainer');
        if (container.children.length >= maxFilters) return;

        const newFilter = document.createElement('div');
        newFilter.className = 'flex gap-2 mb-2 items-center';
        newFilter.innerHTML = `
            <select class="amenity-filter w-full border border-gray-400 px-3 py-2 rounded bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                ${document.querySelector('.amenity-filter').innerHTML}
            </select>
            <button type="button" onclick="this.parentElement.remove()" 
                    class="flex items-center justify-center w-10 h-10 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition-colors">
                <span class="material-icons text-xl">remove</span>
            </button>
        `;
        container.appendChild(newFilter);
    }

    function clearFilters() {
        const container = document.getElementById('amenityFiltersContainer');
        while (container.children.length > 1) {
            container.lastChild.remove();
        }
        container.querySelector('.amenity-filter').value = '';
        document.getElementById('searchInput').value = '';
        loadMarkers();
    }

    function loadMarkers() {
        const keyword = document.getElementById('searchInput').value;
        const amenities = Array.from(document.querySelectorAll('.amenity-filter'))
                            .map(select => select.value)
                            .filter(value => value);

        fetch(mapGetMarkersURL + '?search=' + encodeURIComponent(keyword) + '&amenities=' + encodeURIComponent(amenities.join(',')))
            .then(res => res.json())
            .then(data => {
                clearMarkers();
                data.forEach(item => {
                    const marker = L.marker([item.lat, item.lng]).addTo(map);
                    marker.bindTooltip(item.amenity, { direction: 'top' });
                    marker.bindPopup(`
                        <strong>${item.name}</strong><br>
                        ${item.amenity}<br>
                        ${item.address}<br>
                        ${item.district}<br>
                        ${item.amenity === "Rumah Sakit" ? `
                            Type: ${item.hospital_type}<br>
                            Class: ${item.hospital_class}<br>
                        ` : ''}
                    `);
                    markers.push(marker);
                });
            });
    }

    function loadAmenityOptions() {
        fetch(mapAmenitiesListURL)
            .then(res => res.json())
            .then(options => {
                const template = options.reduce((acc, item) => 
                    acc + `<option value="${item}">${item}</option>`, '');
                
                document.querySelectorAll('.amenity-filter').forEach(select => {
                    select.innerHTML = `<option value="">-- Semua Jenis Fasilitas --</option>${template}`;
                });
            });
    }

    loadAmenityOptions();
    loadMarkers();
</script>
