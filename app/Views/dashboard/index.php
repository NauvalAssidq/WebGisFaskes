<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen font-[Inter]">
<?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="pl-6 pr-6 pt-6">
            <div class="max-w-full mx-auto">
                <!-- Header Section -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Analisis Fasilitas Kesehatan</h1>
                        <p class="text-slate-500 mt-1">Dashboard Komprehensif Fasilitas Kesehatan</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <?php foreach ($amenityCounts as $row): ?>
                    <div class="bg-white p-6 rounded-2xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-sm text-blue-600 font-medium"><?= esc($row['amenity']) ?></span>
                                <h3 class="text-2xl font-bold text-slate-800 mt-2"><?= esc($row['total']) ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100/30 rounded-xl flex items-center justify-center">
                                <span class="material-icons-round text-blue-600 text-2xl">local_hospital</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Data Table Section -->   
                <div>
                    <?php foreach ($groupedFacilities as $amenity => $facilities): ?>
                        <div class="mb-8 last:mb-0 bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                            <div class="px-6 py-5 border-b border-slate-100">
                                <h2 class="text-xl font-semibold text-slate-800">
                                    Data Tabel <?= esc(ucwords(str_replace('_', ' ', $amenity))) ?>
                                </h2>
                            </div>
                            <div class="p-6">
                                <div class="overflow-x-auto rounded-lg border border-slate-100">
                                    <table id="table-all" class="min-w-full divide-y divide-slate-100">
                                        <thead class="bg-slate-50">
                                            <tr>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Nama Faskes</th>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Alamat</th>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Kecamatan</th>
                                                <?php if ($amenity === 'Rumah Sakit'): ?>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Jenis RS</th>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Kelas</th>
                                                <?php endif; ?>
                                                <th class="px-5 py-3.5 text-left text-sm font-medium text-slate-600">Kordinat</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            <?php foreach ($facilities as $index => $facility): ?>
                                            <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="px-5 py-4 text-sm font-medium text-slate-800"><?= esc($facility['name']) ?></td>
                                                <td class="px-5 py-4 text-sm text-slate-600"><?= esc($facility['address']) ?></td>
                                                <td class="px-5 py-4 text-sm text-slate-600"><?= esc($facility['district']) ?></td>
                                                <?php if ($amenity === 'Rumah Sakit'): ?>
                                                <td class="px-5 py-4 text-sm text-slate-600"><?= esc($facility['hospital_type']) ?></td>
                                                <td class="px-5 py-4 text-sm text-slate-600"><?= esc($facility['class']) ?></td>
                                                <?php endif; ?>
                                                <td class="px-5 py-4 text-sm font-mono text-slate-500"><?= esc($facility['lat']) ?>, <?= esc($facility['lng']) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 pagination-container"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.pagination-container').forEach((container) => {
        const wrapper = container.closest('.mb-8');
        const table = wrapper.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const rowsPerPage = 5;
        let currentPage = 1;
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        if (totalPages <= 1) return;

        const updateTable = () => {
            rows.forEach((row, index) => {
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                row.style.display = (index >= start && index < end) ? '' : 'none';
            });
        };

        const createPagination = () => {
            container.innerHTML = '';

            const paginationWrapper = document.createElement('div');
            paginationWrapper.className = 'flex items-center justify-end gap-2';

            const createButton = (text, disabled, clickHandler, extraClasses = '') => {
                const btn = document.createElement('button');
                btn.textContent = text;
                btn.disabled = disabled;
                btn.className = `px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 ${disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'} ${extraClasses}`;
                btn.addEventListener('click', clickHandler);
                return btn;
            };

            const farPrevBtn = createButton('<<', currentPage === 1, () => {
                currentPage = 1;
                updateTable();
                createPagination();
            });

            const prevBtn = createButton('<', currentPage === 1, () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                    createPagination();
                }
            });

            const nextBtn = createButton('>', currentPage === totalPages, () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                    createPagination();
                }
            });

            const farNextBtn = createButton('>>', currentPage === totalPages, () => {
                currentPage = totalPages;
                updateTable();
                createPagination();
            });

            const pageGroup = document.createElement('div');
            pageGroup.className = 'flex gap-1';

            let startPage = Math.max(1, currentPage - 1);
            let endPage = Math.min(totalPages, startPage + 2);

            if (endPage - startPage < 2) {
                startPage = Math.max(1, endPage - 2);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.className = `page-btn w-8 h-8 rounded-lg text-sm ${
                    i === currentPage ? 'bg-blue-600 text-white' : 'text-slate-600 hover:bg-slate-100'
                }`;
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    updateTable();
                    createPagination();
                });
                pageGroup.appendChild(pageBtn);
            }

            paginationWrapper.appendChild(farPrevBtn);
            paginationWrapper.appendChild(prevBtn);
            paginationWrapper.appendChild(pageGroup);
            paginationWrapper.appendChild(nextBtn);
            paginationWrapper.appendChild(farNextBtn);

            container.appendChild(paginationWrapper);
        };

        updateTable();
        createPagination();
    });
});
</script>
</body>
</html>