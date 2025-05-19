<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Health Facilities Map</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

               <!-- Filter Section -->
                <div class="mb-6 bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="p-6">
                        <div class="flex flex-col gap-6">
                            <!-- Search Section -->
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Cari Fasilitas Kesehatan</label>
                                <div class="relative group">
                                    <input type="text" id="searchInput" 
                                        placeholder="Cari berdasarkan nama atau lokasi..." 
                                        class="w-full pl-12 pr-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 text-slate-700 placeholder-slate-400 transition-all"
                                        autocomplete="off">
                                    <span class="absolute left-4 top-3.5 text-slate-400 group-focus-within:text-blue-500">
                                        <span class="material-icons-round text-2xl">search</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Filter Controls -->
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <!-- Filter Group -->
                                <div class="flex-1 flex flex-col gap-3 md:flex-row md:items-center">
                                    <div class="flex-1 relative group">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori Fasilitas</label>
                                        <div class="relative">
                                            <select class="amenity-filter w-full pl-4 pr-10 py-2.5 border-2 border-slate-200 rounded-xl bg-white text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-colors">
                                                <option value="">Pilih Jenis Fasilitas</option>
                                                <!-- Options will be dynamically populated -->
                                            </select>
                                            <span class="absolute right-4 top-3 text-slate-400 group-focus-within:text-blue-500">
                                                <span class="material-icons-round">expand_more</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 md:mt-5">
                                        <button type="button" onclick="applyFilters()"
                                                class="h-12 px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center gap-2 transition-all transform hover:scale-[1.02]">
                                            <span class="material-icons-round text-xl">tune</span>
                                            Terapkan Filter
                                        </button>
                                        <button type="button" onclick="clearFilters()"
                                                class="h-12 px-5 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl flex items-center gap-2 border-2 border-slate-200 transition-all">
                                            <span class="material-icons-round text-xl">refresh</span>
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Filters -->
                            <div id="activeFilters" class="mt-3 flex flex-wrap gap-3 transition-opacity" style="display: none;">
                                <template id="filterTagTemplate">
                                    <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-full flex items-center gap-2 text-sm border border-blue-200">
                                        <span class="filter-text"></span>
                                        <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors">
                                            <span class="material-icons-round text-lg">close</span>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <!-- Filter Status -->
                            <div id="filterStatus" class="text-sm text-slate-500 mt-2 italic" aria-live="polite">
                                Menampilkan semua fasilitas kesehatan
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                .amenity-filter::-ms-expand {
                    display: none;
                }
                .amenity-filter {
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
                }
                </style>

                <!-- Map Container -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <?php echo view('dashboard/layout/map_view'); ?>
                </div>
            </div>
        </main>
    </div>

<style>
.leaflet-container {
    height: 700px;
    border-radius: 0.75rem;
}
</style>

</body>
</html>