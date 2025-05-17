<!-- app/Views/dashboard/layout/navbar.php -->
<header class="h-16 bg-gray-800 text-white flex items-center justify-end px-4">
    <div class="flex items-center">
        <div class="w-10 h-10 bg-gray-500 rounded-full overflow-hidden mr-4">
            <img src="<?= base_url('images/user-placeholder.jpg') ?>" alt="User Image" class="w-full h-auto">
        </div>
        <form action="<?= base_url('login/logout') ?>" method="post" class="m-0">
            <?= csrf_field() ?>
            <button type="submit" class="bg-red-600 border-none text-white py-2 px-3 cursor-pointer rounded hover:bg-red-700 transition duration-200">
                Logout
            </button>
        </form>
    </div>
</header>