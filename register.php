<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        $error_message = "Bul email bazada bar.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role]);

        $_SESSION['user'] = [
            'id'    => $pdo->lastInsertId(),
            'name'  => $name,
            'email' => $email,
            'role'  => $role
        ];
        if ($role == 'freelancer') {
            header("Location: freelancer/dashboard.php");
        } else {
            header("Location: employer/dashboard.php");
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dizimnen ótiw</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Dizimnen ótiw</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" class="border p-4 rounded shadow-sm">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Atıńız</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Atıńız" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Parol</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Parol" required>
                </div>
                <div class="form-group">
                    <label for="role">Rol saylań</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="">Rol saylań</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="employer">Jumıs beriwshi</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Dizimnen ótiw</button>
            </form>
            <p class="text-center mt-3">Yamasa <a href="login.php">Kiriw</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
