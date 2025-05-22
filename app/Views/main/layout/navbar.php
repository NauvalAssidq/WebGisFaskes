<style>[x-cloak] { display: none !important; }</style>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav class="sticky top-0 bg-white border-b border-gray-300 shadow-sm" style="z-index: 1000" x-data="{ mobileOpen: false, profileOpen: false }">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo + Navigation -->
            <div class="flex items-center">
                <a href="/" class="flex items-center text-blue-800 font-bold text-xl">
                    <span class="material-icons text-blue-600 mr-2">place</span>
                    WebGIS Faskes
                </a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-4">
                <?php if (session()->has('username')): ?>
                    <!-- Profile Dropdown (Desktop) -->
                    <div class="relative hidden md:flex items-center" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 focus:outline-none group">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 border border-blue-100">
                                <img src="<?= base_url('assets/profile/' . (session()->get('image') ?? 'default.png')) ?>" alt="Profile" class="w-full h-full object-cover">
                            </div>
                            <div class="text-left hidden sm:block">
                                <div class="text-sm font-semibold text-slate-700"><?= esc(session()->get('username')) ?></div>
                                <div class="text-xs text-slate-500"><?= esc(session()->get('email')) ?></div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transform transition-transform"
                                :class="{ 'rotate-180': profileOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Updated Dropdown -->
                        <div x-show="profileOpen"
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-2 top-full mt-4 w-56 origin-top-right rounded-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1.5">
                                <!-- Beranda -->
                                <a href="<?= base_url('/dashboard') ?>" 
                                class="w-full flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors group">
                                    <span class="material-icons text-slate-400 group-hover:text-blue-600 mr-3">dashboard</span>
                                    <span class="font-medium">Dashboard</span>
                                </a>

                                <!-- Settings -->
                                <a href="<?= base_url('/dashboard/settings') ?>" 
                                class="w-full flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors group">
                                    <span class="material-icons text-slate-400 group-hover:text-blue-600 mr-3">settings</span>
                                    <span class="font-medium">Pengaturan</span>
                                </a>

                                <!-- Logout -->
                                <form action="<?= base_url('login/logout') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <button type="submit" 
                                            class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors group">
                                        <span class="material-icons text-slate-400 group-hover:text-red-600 mr-3">logout</span>
                                        <span class="text-slate-700 group-hover:text-red-600 font-medium transition-colors">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Login Button (Desktop) -->
                    <a href="<?= base_url('login') ?>" class="hidden md:flex items-center gap-2 px-4 py-2 border border-gray-700 text-gray-800 rounded hover:bg-gray-100">
                        <span class="material-icons">person</span> Masuk
                    </a>
                <?php endif; ?>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileOpen = !mobileOpen" class="md:hidden focus:outline-none text-gray-700">
                    <span class="material-icons">menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-cloak class="md:hidden px-4 pb-4 space-y-1">
        <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-blue-600">Beranda</a>
        <a href="/map" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-500 hover:text-white">Peta</a>
        <a href="/daftar-faskes" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-500 hover:text-white">Daftar Faskes</a>
        <a href="/tentang" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-500 hover:text-white">Tentang</a>

        <?php if (session()->has('username')): ?>
            <form action="<?= base_url('login/logout') ?>" method="post" class="pt-2">
                <?= csrf_field() ?>
                <button type="submit" class="w-full px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-100">
                    Keluar
                </button>
            </form>
        <?php else: ?>
            <a href="<?= base_url('login') ?>" class="block px-3 py-2 mt-2 rounded-md text-base font-medium text-gray-800 border border-gray-300 hover:bg-gray-100">
                <span class="material-icons align-middle mr-1">person</span> Masuk
            </a>
        <?php endif; ?>
    </div>
</nav>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            mobileOpen: false,
            profileOpen: false,
            toggleMobileMenu() {
                this.mobileOpen = !this.mobileOpen;
            },
            toggleProfileMenu() {
                this.profileOpen = !this.profileOpen;
            }
        }));
    });
</script>