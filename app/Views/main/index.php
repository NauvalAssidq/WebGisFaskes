<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS Faskes - Pemetaan Fasilitas Kesehatan di Banda Aceh</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .hero-pattern {
            background-color: #f7fafc;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='152' height='152' viewBox='0 0 152 152'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='temple' fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath d='M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
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

    <?= $this->include('main/layout/navbar') ?>

    <!-- Hero Section -->
    <section class="h-[600px] py-16 md:py-24 bg-cover bg-center bg-no-repeat" style="background-image: url('<?= base_url('assets/images/bg-hero.svg') ?>');">
        <div class="max-w-6xl mx-auto px-4 h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center h-full">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-4">WebGIS Faskes</h1>
                    <h2 class="text-xl md:text-2xl font-medium text-gray-700 mb-6">Pemetaan Fasilitas Kesehatan di Banda Aceh</h2>
                    <p class="text-gray-600 mb-8">Temukan lokasi rumah sakit, puskesmas, klinik, apotek, dan fasilitas kesehatan lainnya di Banda Aceh dengan mudah melalui platform pemetaan geografis kami.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/map" class="bg-blue-600 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-700 transition duration-300 text-center">Lihat Peta</a>
                        <a href="/daftar-faskes" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-50 transition duration-300 text-center">Daftar Fasilitas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter and Map Section -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Cari Fasilitas Kesehatan</h2>
                <p class="text-gray-600">Temukan fasilitas kesehatan terdekat sesuai kebutuhan Anda</p>
            </div>

            <div class="mb-8">
                <div class="border border-gray-200 rounded-xl shadow-sm bg-white">
                    <div class="w-full mb-2 border-b border-gray-200 p-4">
                        <div class="relative w-full">
                            <input type="text" id="searchInput" class="w-full pr-12 border border-gray-200 px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" placeholder="Cari nama fasilitas...">
                            <button onclick="searchFacilities()" class="absolute right-2 text-gray-400 p-2 rounded-lg transition">
                                <span class="material-icons text-md">search</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-4 flex flex-wrap items-center gap-2">
                        <button id="toggleFilterBtn" class="flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-md hover:bg-blue-200 transition">
                            <span class="material-icons text-sm">filter_alt</span>
                            Filter
                        </button>

                        <div id="activeFilters" class="flex-1 flex flex-wrap items-center"></div>

                        <button onclick="clearAllFilters()" class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1">
                            <span class="material-icons text-sm">refresh</span>
                            Reset
                        </button>
                    </div>

                    <div id="filterPanel" class="hidden border-t border-gray-200 p-4 bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Jenis Fasilitas</h3>
                                <div id="amenityFilters" class="flex flex-wrap gap-2"></div>
                            </div>

                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Kecamatan</h3>
                                <div id="districtFilters" class="flex flex-wrap gap-2"></div>
                            </div>

                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Tipe Rumah Sakit</h3>
                                <div id="hospitalTypeFilters" class="flex flex-wrap gap-2"></div>
                            </div>

                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Kelas Rumah Sakit</h3>
                                <div id="hospitalClassFilters" class="flex flex-wrap gap-2"></div>
                            </div>

                            <div class="filter-category">
                                <h3 class="font-bold text-gray-800 mb-2">Penyelenggaraan</h3>
                                <div id="careTypeFilters" class="flex flex-wrap gap-2"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button onclick="applyFilters()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Terapkan Filter</button>
                        </div>
                    </div>
                </div>
                <div class="text-sm text-gray-600 py-4">
                    Menampilkan <span id="facilityCount" class="font-bold">0</span> fasilitas kesehatan
                </div>
                <div>
                    <div id="map" class="w-full h-[600px] rounded-xl border border-gray-300">
                        <?= $this->include('main/layout/map_view'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?= $this->include('main/layout/footer') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Init functions if needed
        });
    </script>
</body>
</html>
