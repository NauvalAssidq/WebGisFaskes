<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Health Facilities Map</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
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
<body class="bg-slate-50 min-h-screen font-[Inter]">
<?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="pl-6 pr-6 pt-6">
            <div class="max-w-full mx-auto mb-10">
                <!-- Header Section -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Peta Fasilitas Kesehatan</h1>
                        <p class="text-slate-500 mt-1">Dashboard Komprehensif Fasilitas Kesehatan</p>
                    </div>
                </div> 

                <!-- Filter System -->
                <div class="mb-8">
                    <!-- Search bar -->
                    
                    
                    <!-- Filter container -->
                    <div class="border border-gray-300 rounded-lg shadow-sm bg-white">

                        <div class="w-full mb-4 p-4">
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
                <div class="mt-8 bg-white p-6 rounded-xl border border-gray-200 transform transition-all hover:shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Facility Legend
                    </h3>
                    
                    <div class="flex flex-row space-x-3">
                        <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-red-400 to-red-600 shadow-sm mr-3 transform group-hover:scale-110 transition-all"></div>
                            <span class="text-gray-700 font-medium">Rumah Sakit</span>
                        </div>
                        
                        <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-sm mr-3 transform group-hover:scale-110 transition-all"></div>
                            <span class="text-gray-700 font-medium">Puskesmas</span>
                        </div>
                        
                        <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-green-400 to-green-600 shadow-sm mr-3 transform group-hover:scale-110 transition-all"></div>
                            <span class="text-gray-700 font-medium">Klinik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>