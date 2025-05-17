<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Fasilitas Kesehatan - WebGIS Faskes Banda Aceh</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #map { height: 600px; width: 100%; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Include Navbar -->
    <?= $this->include('main/layout/navbar') ?>

    <main class="flex-grow">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Peta Fasilitas Kesehatan di Banda Aceh</h1>
                <p class="text-gray-600">Temukan lokasi rumah sakit, puskesmas, klinik, apotek, dan fasilitas kesehatan lainnya.</p>
            </div>
            
            <!-- Filter bar -->
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-6 border border-gray-300 p-4 rounded-lg shadow-sm bg-gray-50">
                <div class="w-full sm:w-5/12">
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                    <input type="text" id="searchInput"
                        class="w-full border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama fasilitas..." />
                </div>
                <div class="w-full sm:w-5/12">
                    <label for="amenityFilter" class="block text-sm font-medium text-gray-700 mb-1">Jenis Fasilitas</label>
                    <select id="amenityFilter"
                        class="w-full border border-gray-400 px-3 py-2 rounded bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Semua Jenis Fasilitas --</option>
                    </select>
                </div>
                <div class="w-full sm:w-2/12 pt-6">
                    <button onclick="loadMarkers()"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        <span class="material-icons">search</span>
                        Cari
                    </button>
                </div>
            </div>
            
            <!-- Map -->
            <?= $this->include('main/map_view') ?>

            <!-- Legend -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow-sm border border-gray-300">
                <h3 class="text-lg font-semibold mb-2">Keterangan</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                        <span>Rumah Sakit</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                        <span>Puskesmas</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
                        <span>Klinik</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-purple-500 rounded-full mr-2"></div>
                        <span>Apotek</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Footer -->
    <?= $this->include('main/layout/footer') ?>

    <script>
        // Tambahan untuk memastikan bahwa marker menggunakan warna yang sesuai dengan jenis fasilitas
        function getMarkerColor(amenity) {
            switch(amenity.toLowerCase()) {
                case 'rumah sakit':
                    return 'red';
                case 'puskesmas':
                    return 'blue';
                case 'klinik':
                    return 'green';
                case 'apotek':
                    return 'purple';
                default:
                    return 'gray';
            }
        }

        // Override fungsi loadMarkers untuk menambahkan warna marker sesuai jenis
        function loadMarkers() {
            const keyword = document.getElementById('searchInput').value;
            const amenity = document.getElementById('amenityFilter').value;

            fetch(`/map/getMarkers?search=${encodeURIComponent(keyword)}&amenity=${encodeURIComponent(amenity)}`)
                .then(res => res.json())
                .then(data => {
                    clearMarkers();

                    data.forEach(item => {
                        const markerColor = getMarkerColor(item.amenity);
                        
                        // Custom marker icon dengan warna sesuai jenis fasilitas
                        const markerIcon = L.divIcon({
                            className: 'custom-marker',
                            html: `<span class="material-icons" style="color: ${markerColor};">place</span>`,
                            iconSize: [24, 24],
                            iconAnchor: [12, 24],
                            popupAnchor: [0, -24]
                        });
                        
                        const marker = L.marker([item.lat, item.lng], {icon: markerIcon}).addTo(map);
                        marker.bindTooltip(item.amenity, { direction: 'top' });
                        marker.bindPopup(`
                            <strong>${item.name}</strong><br>
                            <span class="text-gray-600">${item.amenity}</span><br>
                            ${item.address ? `<small>${item.address}</small>` : ''}
                        `);
                        markers.push(marker);
                    });

                    // Auto-zoom untuk melihat semua marker
                    if (markers.length > 0) {
                        const group = new L.featureGroup(markers);
                        map.fitBounds(group.getBounds().pad(0.1));
                    }
                });
        }
    </script>
</body>
</html>