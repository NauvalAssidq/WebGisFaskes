<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Facilities Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #map { height: 600px; width: 100%; }
    </style>
</head>
<body class="bg-white text-gray-800">
    <div class="max-w-6xl mx-auto px-4 py-6 border border-gray-400">
        <h2 class="text-2xl font-semibold mb-4 border-b border-gray-400 pb-2">Healthcare Facilities in Banda Aceh</h2>
        <!-- Filter bar -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-4 border border-gray-300 p-4 rounded">
        <div class="w-full sm:w-auto">
            <input type="text" id="searchInput"
            class="w-full border border-gray-400 px-3 py-2 rounded focus:outline-none"
            placeholder="Search facility name..." />
        </div>
        <div class="w-full sm:w-auto">
            <select id="amenityFilter"
            class="w-full border border-gray-400 px-3 py-2 rounded bg-white text-gray-700 focus:outline-none">
            <option value="">-- All Amenities --</option>
            </select>
        </div>
        <button onclick="loadMarkers()"
            class="flex items-center gap-2 border border-gray-600 text-gray-800 px-4 py-2 rounded hover:bg-gray-100">
            <span class="material-icons">search</span>
            Search
        </button>
        </div>
        <!-- Map -->
        <div id="map" class="border border-gray-400 rounded"></div>
    </div>
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
</body>
</html>
