<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form method="post" action="/login/authenticate" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-xl font-bold mb-4">Login</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <input type="email" name="email" placeholder="Email" required class="mb-3 w-full px-3 py-2 border rounded" />
        <input type="password" name="password" placeholder="Password" required class="mb-3 w-full px-3 py-2 border rounded" />
        <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700">Login</button>
    </form>
</body>
</html>
