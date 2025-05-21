<!-- app/Views/dashboard/list_klinik.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Klinik</title>
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
                        <h1 class="text-3xl font-bold text-slate-800">Daftar Klinik</h1>
                        <p class="text-slate-500 mt-1">Kelola data Klinik</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-x-auto">
                    <!-- Critical: The div ID must match what's used in createTableSearch() -->
                    <div class="p-4" id="search-container-klinik"></div>
                    <table id="table-klinik" class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Kecamatan</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-slate-600 uppercase">Kordinat</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-slate-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($facilities as $f): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->name ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->address ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->district ?? '-') ?></td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-slate-700"><?= esc($f->lat ?? '-') ?> <?= esc($f->lng ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right flex justify-end gap-2">
                                    <a href="<?= site_url('dashboard/edit/' . $f->id) ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-blue-100 hover:bg-blue-200 text-blue-600">
                                        <span class="material-icons-round text-base">edit</span>
                                    </a>
                                    <form action="<?= site_url('dashboard/delete/' . $f->id) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                            <span class="material-icons-round text-base">delete</span>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="p-4" id="pagination-klinik"></div>

                </div>
            </div>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = createTableSearch('search-container-klinik', 'Search facilities...');
        
        const table = document.getElementById('table-klinik');
        const paginationContainer = document.getElementById('pagination-klinik');
        
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