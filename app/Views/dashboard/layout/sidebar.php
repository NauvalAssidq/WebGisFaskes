<?php
$segment1 = service('uri')->getSegment(1);
$segment2 = service('uri')->getSegment(2);
?>

<aside class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-gray-200">
    <div class="p-6 pb-4">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
            <span class="text-blue-600">WebGIS</span> Faskes
        </h2>
    </div>

    <nav class="px-3">
        <div class="mb-4 px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Pages
        </div>

        <ul class="space-y-1">
            <li>
                <a href="<?= base_url('dashboard') ?>"
                   class="flex items-center p-3 rounded-lg group transition-all duration-200 
                   <?= ($segment1 == 'dashboard' && $segment2 == null) ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-blue-50' ?>">
                    <svg class="w-5 h-5 mr-3 <?= ($segment1 == 'dashboard' && $segment2 == null) ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == null) ? 'text-white' : 'text-slate-700 group-hover:text-blue-600' ?>">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?= base_url('dashboard/map') ?>"
                   class="flex items-center p-3 rounded-lg group transition-all duration-200 
                   <?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-blue-50' ?>">
                    <svg class="w-5 h-5 mr-3 <?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="<?= ($segment1 == 'dashboard' && $segment2 == 'map') ? 'text-blue-600' : 'text-slate-700 group-hover:text-blue-600' ?>">Peta</span>
                </a>
            </li>

            <li>
                <a href="<?= base_url('edit') ?>"
                   class="flex items-center p-3 rounded-lg group transition-all duration-200 
                   <?= $segment1 == 'edit' ? 'bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-blue-50' ?>">
                    <svg class="w-5 h-5 mr-3 <?= $segment1 == 'edit' ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span class="<?= $segment1 == 'edit' ? 'text-blue-600' : 'text-slate-700 group-hover:text-blue-600' ?>">Edit</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
        <a href="<?= base_url('settings') ?>"
           class="flex items-center p-3 rounded-lg group transition-all duration-200 
           <?= $segment1 == 'settings' ? 'bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-blue-50' ?>">
            <svg class="w-5 h-5 mr-3 <?= $segment1 == 'settings' ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="<?= $segment1 == 'settings' ? 'text-blue-600' : 'text-slate-700 group-hover:text-blue-600' ?>">Settings</span>
        </a>

        <form action="<?= base_url('login/logout') ?>" method="post" class="m-0">
            <?= csrf_field() ?>
            <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 group transition-all duration-200">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="text-slate-700 group-hover:text-red-600 font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>
