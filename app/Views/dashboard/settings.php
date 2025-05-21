<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>WebGis Faskes | Pengaturan Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 1rem;
        }
        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50">
    <?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="px-8 py-6">
            <div class="max-w-full mx-auto">
                <!-- Header Section -->
                <div class="mb-8 space-y-1">
                    <h1 class="text-2xl font-semibold text-gray-900">Pengaturan Akun</h1>
                    <p class="text-gray-500">Kelola preferensi akun dan pengaturan keamanan Anda</p>
                </div>

                <!-- Notifications -->
                <?php if (session()->getFlashdata('message')): ?>
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 animate-slide-down">
                    <div class="flex items-center space-x-3">
                        <span class="material-icons-round text-green-600">check_circle</span>
                        <p class="text-green-700 font-medium"><?= session()->getFlashdata('message') ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 animate-slide-down">
                    <div class="flex items-center space-x-3">
                        <span class="material-icons-round text-red-600">error</span>
                        <p class="text-red-700 font-medium"><?= session()->getFlashdata('error') ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Settings Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                    <form action="<?= site_url('dashboard/settings/update') ?>" method="post" class="divide-y divide-gray-100">
                        <?= csrf_field() ?>

                        <!-- Profile Section -->
                        <div class="p-8 space-y-6">
                            <div class="space-y-1">
                                <h3 class="text-lg font-semibold text-gray-900">Foto Profil</h3>
                                <p class="text-sm text-gray-500">Pilih dari koleksi avatar yang telah disediakan</p>
                            </div>

                            <!-- Avatar Grid -->
                            <div class="profile-grid mt-6">
                                <?php foreach (array_slice($profileImages, 0, 10) as $image): ?>
                                <label class="relative cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="image" 
                                        value="<?= $image ?>" 
                                        class="hidden peer"
                                        <?= ($user['image'] == $image) ? 'checked' : '' ?>
                                        onchange="document.getElementById('preview-image').src = '<?= base_url('assets/profile/' . $image) ?>'"
                                    >
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 border-transparent peer-checked:border-blue-500 transition-all hover:border-blue-300">
                                        <img 
                                            src="<?= base_url('assets/profile/' . $image) ?>" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                    <div class="absolute top-1 right-1 w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center transform scale-0 peer-checked:scale-100 transition">
                                        <span class="material-icons-round text-white text-xs">check</span>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                            <!-- Account Details -->
                            <div class="p-8 space-y-6">
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold text-gray-900">Informasi Akun</h3>
                                    <p class="text-sm text-gray-500">Perbarui detail akun dasar Anda</p>
                                </div>

                                <div class="space-y-4">
                                    <!-- Username -->
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700">Nama Pengguna</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                                <span class="material-icons-round text-sm">person</span>
                                            </span>
                                            <input 
                                                type="text" 
                                                name="username" 
                                                value="<?= esc($user->username ?? '') ?>" 
                                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                                            >
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700">Alamat Email</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                                <span class="material-icons-round text-sm">email</span>
                                            </span>
                                            <input 
                                                type="email" 
                                                name="email" 
                                                value="<?= esc($user->email ?? '') ?>" 
                                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="p-8 space-y-6">
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold text-gray-900">Keamanan</h3>
                                    <p class="text-sm text-gray-500">Kelola kata sandi dan pengaturan autentikasi Anda</p>
                                </div>

                                <div class="space-y-4">
                                    <!-- Current Password -->
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700">Kata Sandi Saat Ini</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                                <span class="material-icons-round text-sm">lock</span>
                                            </span>
                                            <input 
                                                type="password" 
                                                name="current_password" 
                                                placeholder="Wajib untuk melakukan perubahan" 
                                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                                            >
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                                <span class="material-icons-round text-sm">vpn_key</span>
                                            </span>
                                            <input 
                                                type="password" 
                                                name="password" 
                                                placeholder="Biarkan kosong jika tidak ingin diubah" 
                                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                                            >
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                                <span class="material-icons-round text-sm">check_circle</span>
                                            </span>
                                            <input 
                                                type="password" 
                                                name="password_confirm" 
                                                placeholder="Konfirmasi kata sandi baru Anda" 
                                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-8 flex justify-end">
                            <button 
                                type="submit" 
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all flex items-center space-x-2 shadow-sm hover:shadow-md"
                            >
                                <span class="material-icons-round text-sm">save</span>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
