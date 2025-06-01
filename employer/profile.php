<?php
session_start();
include('../auth.php');
include('../db.php');
$employer_id = $_SESSION['user']['id'];
$query = "SELECT name, email FROM users WHERE id = :employer_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$employer = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ?? null;
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :employer_id";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':password', $hashedPassword);
    } else {
        $updateQuery = "UPDATE users SET name = :name, email = :email WHERE id = :employer_id";
        $stmt = $pdo->prepare($updateQuery);
    }

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Profildi Ózgertiriw</h2>
    <form method="POST" action="profile.php">
        <div class="form-group">
            <label for="name">Atıńız</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($employer['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($employer['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Parol (eger ózgertiw kerek bolsa)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Profildi jańalaw</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
