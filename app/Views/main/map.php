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
        .marker-pin {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: relative;
        }
        .custom-marker {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .filter-group .filter-item label {
            cursor: pointer;
        }
        .filter-badge {
            display: inline-flex;
            align-items: center;
            background: #e0f2fe;
            border: 1px solid #7dd3fc;
            border-radius: 9999px;
            padding: 2px 8px;
            margin: 2px;
            font-size: 0.85rem;
        }
        .filter-badge .remove {
            margin-left: 4px;
            cursor: pointer;
            color: #0369a1;
        }
        .filter-badge .remove:hover {
            color: #be123c;
        }
        .filter-category {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .filter-category:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Header Placeholder -->
    <header class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold">WebGIS Faskes Banda Aceh</h1>
        </div>
    </header>

    <main class="flex-grow">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Peta Fasilitas Kesehatan di Banda Aceh</h1>
                <p class="text-gray-600">Temukan lokasi rumah sakit, puskesmas, klinik, apotek, dan fasilitas kesehatan lainnya.</p>
            </div>
            
            <!-- Filter System -->
            <div class="mb-8">
                <!-- Search bar -->
                <div class="w-full mb-4">
                    <div class="flex">
                        <input type="text" id="searchInput"
                            class="w-full border border-gray-400 px-3 py-2 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Cari nama fasilitas...">
                        <button onclick="searchFacilities()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700 transition flex items-center">
                            <span class="material-icons">search</span>
                        </button>
                    </div>
                </div>
                
                <!-- Filter container -->
                <div class="border border-gray-300 rounded-lg shadow-sm bg-white">
                    <!-- Filter Button & Active Filters -->
                    <div class="p-4 flex flex-wrap items-center gap-2">
                        <button id="toggleFilterBtn" 
                            class="flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-md hover:bg-blue-200 transition">
                            <span class="material-icons text-sm">filter_alt</span>
                            Filter
                        </button>
                        
                        <div id="activeFilters" class="flex-1 flex flex-wrap items-center">
                            <!-- Active filters will be shown here as badges -->
                        </div>
                        
                        <button onclick="clearAllFilters()"
                            class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1">
                            <span class="material-icons text-sm">refresh</span>
                            Reset
                        </button>
                    </div>
                    
                    <!-- Expandable Filter Panel -->
                    <div id="filterPanel" class="hidden border-t border-gray-200 p-4 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Jenis Fasilitas -->
                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Jenis Fasilitas</h3>
                                <div id="amenityFilters" class="flex flex-wrap gap-2">
                                    <!-- Will be populated dynamically -->
                                </div>
                            </div>
                            
                            <!-- Kecamatan -->
                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Kecamatan</h3>
                                <div id="districtFilters" class="flex flex-wrap gap-2">
                                    <!-- Will be populated dynamically -->
                                </div>
                            </div>
                            
                            <!-- Tipe Rumah Sakit -->
                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Tipe Rumah Sakit</h3>
                                <div id="hospitalTypeFilters" class="flex flex-wrap gap-2">
                                    <!-- Will be populated dynamically -->
                                </div>
                            </div>
                            
                            <!-- Kelas Rumah Sakit -->
                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Kelas Rumah Sakit</h3>
                                <div id="hospitalClassFilters" class="flex flex-wrap gap-2">
                                    <!-- Will be populated dynamically -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Apply Button -->
                        <div class="mt-4 flex justify-end">
                            <button onclick="applyFilters()" 
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Terapkan Filter
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Facility Count -->
                <div class="text-sm text-gray-600 mt-4">
                    Menampilkan <span id="facilityCount" class="font-bold">0</span> fasilitas kesehatan
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="max-w-6xl mx-auto text-center">
            <p>© 2025 WebGIS Fasilitas Kesehatan Banda Aceh</p>
        </div>
    </footer>