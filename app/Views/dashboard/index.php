<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<?= $this->include('dashboard/layout/sidebar') ?>
    <div class="ml-64">
        <?= $this->include('dashboard/layout/header') ?>
        <main class="pl-4 pr-4 pt-4">
            <h1 class="text-2xl font-bold mb-4">Welcome to the Dashboard</h1>
            <p class="mb-2"><strong>Username:</strong> <?= esc($username) ?></p>
            <p class="mb-6"><strong>Email:</strong> <?= esc($email) ?></p>
        </main>

    </div>

</body>
</html>
