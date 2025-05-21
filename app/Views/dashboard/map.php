<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>WebGis Faskes | Dashboard Peta</title>
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
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-slate-800">Analisis Fasilitas Kesehatan</h1>
                <p class="text-slate-500 mt-1">Dashboard Komprehensif Fasilitas Kesehatan</p>
            </div>
            <div class="max-w-full mx-auto mb-10">
                <div class="mb-8">
                    <div class="border border-gray-200 rounded-xl shadow-sm bg-white">
                       <div class="w-full mb-2 border-b border-gray-200 p-4">
                            <div class="relative w-full">
                                <input type="text" id="searchInput"
                                    class="w-full pr-12 border border-gray-200 px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                                    placeholder="Cari nama fasilitas...">
                                <button onclick="searchFacilities()"
                                    class="absolute right-2 text-gray-400 p-2 rounded-lg transition">
                                    <span class="material-icons text-md ">search</span>
                                </button>
                            </div>
                        </div>
                        <div class="p-4 flex flex-wrap items-center gap-2">
                            <button id="toggleFilterBtn" 
                                class="flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-md hover:bg-blue-200 transition">
                                <span class="material-icons text-sm">filter_alt</span>
                                Filter
                            </button>
                            
                            <div id="activeFilters" class="flex-1 flex flex-wrap items-center">
                            </div>
                            
                            <button onclick="clearAllFilters()"
                                class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1">
                                <span class="material-icons text-sm">refresh</span>
                                Reset
                            </button>
                        </div>
                        
                        <div id="filterPanel" class="hidden border-t border-gray-200 p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="filter-category">
                                    <h3 class="font-bold text-gray-800 mb-2">Jenis Fasilitas</h3>
                                    <div id="amenityFilters" class="flex flex-wrap gap-2">
                                    </div>
                                </div>
                                
                                <div class="filter-category">
                                    <h3 class="font-bold text-gray-800 mb-2">Kecamatan</h3>
                                    <div id="districtFilters" class="flex flex-wrap gap-2">
                                    </div>
                                </div>
                                
                                <div class="filter-category">
                                    <h3 class="font-bold text-gray-800 mb-2">Tipe Rumah Sakit</h3>
                                    <div id="hospitalTypeFilters" class="flex flex-wrap gap-2">
                                    </div>
                                </div>
                                
                                <div class="filter-category">
                                    <h3 class="font-bold text-gray-800 mb-2">Kelas Rumah Sakit</h3>
                                    <div id="hospitalClassFilters" class="flex flex-wrap gap-2">
                                    </div>
                                </div>

                                <div class="filter-category">
                                    <h3 class="font-bold text-gray-800 mb-2">Penyelenggaraan</h3>
                                    <div id="careTypeFilters" class="flex flex-wrap gap-2">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex justify-end">
                                <button onclick="applyFilters()" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                    Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm mt 10 text-gray-600 py-4">
                        Menampilkan <span id="facilityCount" class="font-bold">0</span> fasilitas kesehatan
                    </div>
                    <div>
                        <div id="map" class="w-full h-[600px] rounded-xl border border-gray-300"><?= $this->include('dashboard/layout/map_view');?></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>