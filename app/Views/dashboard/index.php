<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="pl-4 pr-4 pt-4">
            <h1 class="text-2xl font-bold mb-4">Top 3 Amenity Types</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($amenityCounts as $row): ?>
                    <div class="p-4 border rounded shadow">
                        <h2 class="text-lg font-semibold"><?= esc($row['amenity']) ?></h2>
                        <p class="text-gray-600">Jumlah: <?= esc($row['total']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Fasilitas Kesehatan Berdasarkan Kategori</h2>
                <?php foreach ($groupedFacilities as $amenity => $facilities): ?>
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-blue-600 mb-4 px-2 py-1 bg-blue-50 rounded">
                            <?= esc(ucwords(str_replace('_', ' ', $amenity))) ?>
                        </h3>
                        
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Fasilitas</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($facilities as $index => $facility): ?>
                                    <tr class="<?= $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' ?>">
                                        <td class="px-4 py-3 text-sm text-gray-500"><?= $index + 1 ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-800 font-medium"><?= esc($facility['name']) ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            <span class="font-mono"><?= esc($facility['lat']) ?>, <?= esc($facility['lng']) ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>
