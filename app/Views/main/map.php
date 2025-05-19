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
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-8 border border-gray-300 p-4 rounded-lg shadow-sm bg-gray-50">
                <div class="w-full sm:w-5/12">
                    <input type="text" id="searchInput"
                        class="w-full border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari nama fasilitas...">
                </div>
                
                <div class="w-full sm:w-5/12" id="amenityFiltersContainer">
                    <div class="flex gap-2 mb-2 items-center">
                        <select class="amenity-filter w-full border border-gray-400 px-3 py-2 rounded bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Semua Jenis Fasilitas --</option>
                        </select>
                        <button type="button" onclick="addAmenityFilter()" 
                                class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition-colors">
                            <span class="material-icons text-xl">add</span>
                        </button>
                    </div>
                </div>

                <div class="w-full sm:w-2/12 flex gap-2">
                    <button onclick="loadMarkers()"
                        class="w-full flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        <span class="material-icons">search</span>
                        Cari
                    </button>
                    <button onclick="clearFilters()"
                        class="w-full flex items-center justify-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                        <span class="material-icons">refresh</span>
                    </button>
                </div>
            </div>
            
            <!-- Map -->
            <?= $this->include('main/layout/map_view') ?>

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

    <?= $this->include('main/layout/footer') ?>
</body>
</html>