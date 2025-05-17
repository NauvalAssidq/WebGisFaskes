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
        #map { height: 500px; width: 100%; }
        .hero-pattern {
            background-color: #f7fafc;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='152' height='152' viewBox='0 0 152 152'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='temple' fill='%23e2e8f0' fill-opacity='0.4'%3E%3Cpath d='M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Include Navbar -->
    <?= $this->include('main/layout/navbar') ?>

    <!-- Hero Section -->
    <section class="hero-pattern py-16 md:py-24">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-4">WebGIS Faskes</h1>
                    <h2 class="text-xl md:text-2xl font-medium text-gray-700 mb-6">Pemetaan Fasilitas Kesehatan di Banda Aceh</h2>
                    <p class="text-gray-600 mb-8">Temukan lokasi rumah sakit, puskesmas, klinik, apotek, dan fasilitas kesehatan lainnya di Banda Aceh dengan mudah melalui platform pemetaan geografis kami.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/peta" class="bg-blue-600 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-700 transition duration-300 text-center">Lihat Peta</a>
                        <a href="/daftar-faskes" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-50 transition duration-300 text-center">Daftar Fasilitas</a>
                    </div>
                </div>
                <div class="rounded-lg shadow-lg overflow-hidden">
                    <img src="/assets/images/healthcare-map.jpg" alt="Peta Fasilitas Kesehatan" class="w-full" onerror="this.src='/api/placeholder/600/400';this.onerror=null;">
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Cari Fasilitas Kesehatan</h2>
                <p class="text-gray-600">Temukan fasilitas kesehatan terdekat sesuai kebutuhan Anda</p>
            </div>
            
            <!-- Filter bar -->
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-8 border border-gray-300 p-4 rounded-lg shadow-sm bg-gray-50">
                <div class="w-full sm:w-5/12">
                    <input type="text" id="searchInput"
                        class="w-full border border-gray-400 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Cari nama fasilitas..." />
                </div>
                <div class="w-full sm:w-5/12">
                    <select id="amenityFilter"
                        class="w-full border border-gray-400 px-3 py-2 rounded bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Semua Jenis Fasilitas --</option>
                    </select>
                </div>
                <button onclick="loadMarkers()"
                    class="w-full sm:w-2/12 flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    <span class="material-icons">search</span>
                    Cari
                </button>
            </div>
            
            <!-- Map -->
            <?= $this->include('main/map_view') ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Fitur Utama</h2>
                <p class="text-gray-600">Beragam fitur untuk memudahkan pencarian fasilitas kesehatan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full text-blue-600 mb-4">
                        <span class="material-icons">place</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pemetaan Interaktif</h3>
                    <p class="text-gray-600">Visualisasi lokasi fasilitas kesehatan dengan peta interaktif dan mudah digunakan.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full text-blue-600 mb-4">
                        <span class="material-icons">search</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pencarian Terfokus</h3>
                    <p class="text-gray-600">Temukan fasilitas kesehatan berdasarkan nama, jenis, dan lokasi dengan mudah.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full text-blue-600 mb-4">
                        <span class="material-icons">info</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Informasi Lengkap</h3>
                    <p class="text-gray-600">Akses informasi detail tentang setiap fasilitas kesehatan termasuk jam operasional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-12 bg-blue-700 text-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold mb-2">20+</p>
                    <p class="text-xl">Rumah Sakit</p>
                </div>
                <div>
                    <p class="text-4xl font-bold mb-2">45+</p>
                    <p class="text-xl">Puskesmas</p>
                </div>
                <div>
                    <p class="text-4xl font-bold mb-2">100+</p>
                    <p class="text-xl">Klinik</p>
                </div>
                <div>
                    <p class="text-4xl font-bold mb-2">200+</p>
                    <p class="text-xl">Apotek</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?= $this->include('main/layout/footer') ?>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Additional JavaScript for mobile menu toggle could go here
        });
    </script>
</body>
</html>