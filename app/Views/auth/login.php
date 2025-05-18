<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WebGIS Faskes Banda Aceh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Include Navbar -->
    <?= $this->include('main/layout/navbar') ?>

    <div class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="border border-gray-300 rounded-lg bg-white p-8">
                <div class="text-center mb-6">
                    <div class="flex justify-center mb-4">
                        <span class="material-icons text-blue-600 text-4xl">place</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Masuk ke WebGIS Faskes</h2>
                    <p class="text-gray-600 mt-2">Akses sistem pemetaan fasilitas kesehatan</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-md mb-4">
                        <div class="flex items-center">
                            <span class="material-icons text-red-500 mr-2">error</span>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" action="/login/authenticate">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">email</span>
                            </div>
                            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required 
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400 text-lg">lock</span>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required 
                                class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>
                        <a href="/lupa-password" class="text-sm text-blue-600 hover:text-blue-800">Lupa kata sandi?</a>
                    </div>
                    
                    <button type="submit" class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="material-icons mr-2">login</span>
                        Masuk
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum memiliki akun? 
                        <a href="/register" class="font-medium text-blue-600 hover:text-blue-500">
                            Daftar sekarang
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

    <!-- We don't include the full footer here as it would make the login page too cluttered -->
</body>
</html>