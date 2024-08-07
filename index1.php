<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <title>Sign in with Microsoft</title>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</p>
<?php else: ?>
    <a href="/auth.php">Sign in with Microsoft</a>
<?php endif; ?>
</body>
</html>  