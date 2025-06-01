<?php
session_start();
include('../auth.php');
include('../db.php');
$user_id = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p class='text-danger'>Paydalanıwshı tabılmadı.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :user_id";
    } else {
        $update_query = "UPDATE users SET name = :name, email = :email WHERE id = :user_id";
    }

    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $update_stmt->bindParam(':email', $email, PDO::PARAM_STR);
    if (!empty($password)) {
        $update_stmt->bindParam(':password', $password, PDO::PARAM_STR);
    }
    $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    if ($update_stmt->execute()) {
        echo "<p class='text-success'>Profil jańalandı!</p>";
        $user['name'] = $name;
        $user['email'] = $email;
    } else {
        echo "<p class='text-danger'>Profildi jańalawda qatelik.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profildi jańalaw</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php');?>

<div class="container mt-4">
    <h2>Profildi jańalaw</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Atıńız</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Parol</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Paroldi ózgertiw ushın kiritiń">
        </div>
        <button type="submit" class="btn btn-primary">Jańalaw</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
