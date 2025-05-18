<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - WebGIS Faskes Banda Aceh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <?= $this->include('main/layout/navbar') ?>

    <div class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="border border-gray-300 rounded-lg bg-white p-8">
                <div class="text-center mb-6">
                    <div class="flex justify-center mb-4">
                        <span class="material-icons text-blue-600 text-4xl">person_add</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
                    <p class="text-gray-600 mt-2">Buat akun untuk mulai menggunakan sistem</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-md mb-4">
                        <div class="flex items-center">
                            <span class="material-icons text-red-500 mr-2">error</span>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" action="/register">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">person</span>
                            </div>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">badge</span>
                            </div>
                            <input type="text" id="username" name="username" placeholder="Masukkan username" required
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">email</span>
                            </div>
                            <input type="email" id="email" name="email" placeholder="Masukkan email" required
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">lock</span>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Buat kata sandi" required
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="material-icons mr-2">person_add</span>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="/login" class="font-medium text-blue-600 hover:text-blue-500">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    &copy; <?= date('Y') ?> WebGIS Faskes Banda Aceh. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </div>
</body>
</html>