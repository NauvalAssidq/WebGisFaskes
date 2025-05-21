<?php
$segment1 = service('uri')->getSegment(1);
$segment2 = service('uri')->getSegment(2);
?>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<style>
.material-symbols-outlined {
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}
</style>

<aside class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200">
    <div class="p-6 pb-4">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
        <span class="text-blue-600">WebGIS</span> Faskes
        </h2>
    </div>

    <nav class="px-3">
        <div class="mb-4 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
        Halaman
        </div>
        <ul class="space-y-1">
            <li>
                <a href="<?= base_url('dashboard') ?>"
                    class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == null) ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == null) ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">dashboard</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == null) ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('dashboard/map') ?>"
                class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">map</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Peta</span>
                </a>
            </li>
        </ul>

        <div class="mb-4 mt-6 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
        List Fasilitas Kesehatan
        </div>
        <ul class="space-y-1">
            <li>
                <a href="<?= base_url('dashboard/puskesmas') ?>"
                class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == 'puskesmas') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == 'puskesmas') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">vaccines</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'puskesmas') ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Puskesmas</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('dashboard/rumahsakit') ?>"
                class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == 'rumahsakit') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == 'rumahsakit') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">local_hospital</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'rumahsakit') ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Rumah Sakit</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('dashboard/klinik') ?>"
                class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == 'klinik') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == 'klinik') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">medical_services</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'klinik') ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Klinik</span>
                </a>
            </li>
        </ul>

        <div class="mb-4 mt-6 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
        Tambah Fasilitas Kesehatan
        </div>
        <ul class="space-y-1">
            <li>
                <a href="<?= base_url('dashboard/tambah') ?>"
                class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= ($segment1 == 'dashboard' && $segment2 == 'tambah') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= ($segment1 == 'dashboard' && $segment2 == 'tambah') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>">add</span>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'tambah') ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Tambah Data</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
        <a href="<?= base_url('dashboard/settings') ?>"
        class="flex items-center p-3 rounded-lg group transition-all duration-200 <?= $segment1 == 'settings' ? 'bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-blue-50' ?>">
            <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center <?= $segment1 == 'settings' ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' ?>">settings</span>
            <span class="<?= $segment1 == 'settings' ? 'text-blue-600' : 'text-slate-700 group-hover:text-blue-600' ?>">Pengaturan</span>
        </a>

        <form action="<?= base_url('login/logout') ?>" method="post" class="m-0">
        <?= csrf_field() ?>
        <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 group transition-all duration-200">
            <span class="material-symbols-outlined w-6 h-6 mr-3 flex items-center justify-center text-slate-400 group-hover:text-red-600">logout</span>
            <span class="text-slate-700 group-hover:text-red-600">Keluar</span>
        </button>
        </form>
    </div>
</aside>
