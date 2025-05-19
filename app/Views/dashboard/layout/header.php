<!-- app/Views/dashboard/layout/navbar.php -->
<!-- Ensure this is in your base layout -->
<style>[x-cloak] { display: none !important; }</style>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<header class="sticky top-0 h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6" style="z-index: 2000;">
    <div></div>

    <div class="flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
        <div class="relative">
            <!-- Avatar Button -->
            <button 
                @click="open = !open"
                class="flex items-center gap-3 focus:outline-none group"
            >
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 border border-blue-50 overflow-hidden">
                    <img src="<?= base_url('images/user-placeholder.jpg') ?>" 
                         alt="User profile" 
                         class="w-full h-full object-cover">
                </div>
                <div class="text-left hidden sm:block">
                    <div class="text-sm font-semibold text-slate-700"><?= esc($username) ?></div>
                    <div class="text-xs text-slate-500"><?= esc($email) ?></div>
                </div>
                <svg class="w-4 h-4 text-slate-400 transition-transform transform group-hover:text-slate-600"
                     :class="{ 'rotate-180': open }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-[15px] w-48 origin-top-right rounded-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                <div class="py-1.5">
                    <form action="<?= base_url('login/logout') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors group">
                            <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-red-600 transition-colors"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="text-slate-700 group-hover:text-red-600 font-medium transition-colors">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
