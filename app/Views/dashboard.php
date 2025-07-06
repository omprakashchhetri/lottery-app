<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>🎉 Welcome, <?= esc($user->username) ?>!</h2>
    <p>Email: <?= esc($user->email) ?></p>
    <p>Role: <?= implode(', ', $user->getGroups()) ?></p>

    <a href="<?= site_url('logout') ?>">Logout</a>
</body>
</html>
