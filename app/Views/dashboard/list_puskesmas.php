<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Puskesmas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
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
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Kecamatan</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-slate-600 uppercase">Penyelenggaraan</th>
                                <th class="px-6 py-3 text-center text-sm font-medium text-slate-600 uppercase">Kordinat</th>
                                <th class="px-6 py-3 text-right text-sm font-medium text-slate-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($facilities as $f): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->name ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->address ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->district ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= esc($f->care_type ?? '-') ?></td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-slate-700"><?= esc($f->lat ?? '-') ?> <?= esc($f->lng ?? '-') ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                    <a href="<?= site_url('dashboard/edit/' . $f->id) ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>