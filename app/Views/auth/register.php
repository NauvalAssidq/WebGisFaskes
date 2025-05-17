<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form action="/register" method="post" class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 text-red-600 text-sm"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <input type="text" name="name" placeholder="Full Name"
            class="w-full mb-3 px-3 py-2 border rounded" required>

        <input type="text" name="username" placeholder="Username"
            class="w-full mb-3 px-3 py-2 border rounded" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 px-3 py-2 border rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-4 px-3 py-2 border rounded" required>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>

        <p class="mt-4 text-center text-sm">
            Already have an account? <a href="/login" class="text-blue-500 hover:underline">Login</a>
        </p>
    </form>
</body>
</html>
