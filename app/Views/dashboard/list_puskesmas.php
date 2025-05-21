<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>WebGis Faskes | Daftar Puskesmas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="<?= base_url('assets/scripts/pagination.js') ?>"></script>
</head>
<body class="bg-slate-50 min-h-screen font-[Inter]">
    <?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="pl-6 pr-6 pt-6">
            <div class="max-w-full mx-auto mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Daftar Puskesmas</h1>
                        <p class="text-slate-500 mt-1">Kelola data Puskesmas</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-x-auto">
                    <div class="p-4" id="search-container-pks"></div>
                    <table id="table-pks" class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Gambar</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Kecamatan</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Penyelenggaraan</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-slate-600 uppercase">Kordinat</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-slate-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($facilities as $f): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                    <img 
                                        src="<?= $f->image ? base_url('public/uploads/' . $f->image) : base_url('assets/images/no-image.webp') ?>" 
                                        alt="<?= esc($f->name ?? 'No Image') ?>" 
                                        class="w-16 h-16 object-cover rounded-lg" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->name ?? '-') ?></td>
                                <td class="px-6 py-4 max-w-[200px] truncate whitespace-nowrap text-sm text-slate-700" title="<?= esc($f->address) ?>">
                                    <?= esc($f->address) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->district ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->care_type ?? '-') ?></td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-slate-700">
                                    <div class="inline-flex items-center gap-1 px-2 py-1 border border-gray-300 rounded bg-gray-50 text-xs">
                                        <span class="text-blue-500 text-base leading-none">•</span>
                                        <?= number_format($f->lat, 5) ?>, <?= number_format($f->lng, 5) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                    <div class="flex items-center justify-end gap-2 h-full">
                                        <a href="<?= site_url('dashboard/edit/' . $f->id) ?>" 
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-blue-100 hover:bg-blue-200 text-blue-600">
                                            <span class="material-icons-round text-base">edit</span>
                                        </a>
                                        <form action="<?= site_url('dashboard/delete/' . $f->id) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                                <span class="material-icons-round text-base">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="p-4" id="pagination-pks"></div>
                </div>
            </div>
        </main>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = createTableSearch('search-container-pks', 'Search facilities...');
        
        const table = document.getElementById('table-pks');
        const paginationContainer = document.getElementById('pagination-pks');
        
        console.log('Table element:', table);
        console.log('Pagination container:', paginationContainer);
        console.log('Search input:', searchInput);
        
        if (table && paginationContainer && searchInput) {
            createTablePagination(
                table, 
                paginationContainer, 
                10, 
                searchInput, 
                [0, 1, 2] 
            );
        } else {
            console.error('Missing required elements for pagination');
        }
    });
    </script>
</body>
</html>