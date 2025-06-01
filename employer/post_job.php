<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../auth.php');
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];

    $query = "INSERT INTO jobs (title, description, budget, deadline, employer_id) VALUES (:title, :description, :budget, :deadline, :employer_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':deadline', $deadline);
    $stmt->bindParam(':employer_id', $_SESSION['user']['id']);
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
    <title>Taza vakansiya qosıw</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php');?>

<div class="container mt-4">
    <h2>Taza vakansiya qosıw</h2>
    
    <form method="POST" action="post_job.php">
        <div class="form-group">
            <label for="title">Vakansiya atı</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Vakansiya haqqında</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="budget">Byudjet</label>
            <input type="number" class="form-control" id="budget" name="budget" required>
        </div>
        <div class="form-group">
            <label for="deadline">Múddet</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required>
        </div>
        <button type="submit" class="btn btn-primary">Qosıw</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
