<?php
session_start();
include('../auth.php');
if (!isset($_GET['job_id'])) {
    header('Location: dashboard.php');
    exit();
}

$job_id = $_GET['job_id'];
include('../db.php');
$query = "SELECT * FROM jobs WHERE id = :job_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    echo "<p class='text-danger'>Bunday vakansiya tabılmadı.</p>";
    exit();
}
if (!$job || $job['status'] === 'close') {
    echo "<p class='text-danger'>Bul vakansiya jawılǵan. Endi arza jiberiw múmkin emes.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $cover_letter = htmlspecialchars($_POST['cover_letter']);
    $apply_query = "INSERT INTO applications (job_id, freelancer_id, cover_letter, status) VALUES (:job_id, :freelancer_id, :cover_letter, 'pending')";
    $apply_stmt = $pdo->prepare($apply_query);
    $apply_stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
    $apply_stmt->bindParam(':freelancer_id', $user_id, PDO::PARAM_INT);
    $apply_stmt->bindParam(':cover_letter', $cover_letter, PDO::PARAM_STR);

    if ($apply_stmt->execute()) {
        echo "<p class='text-success'>Arizańız jiberildi!</p>";
    } else {
        echo "<p class='text-danger'>Arza jiberiwde qatelik.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arza jiberiw</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Arza jiberiw: <?php echo htmlspecialchars($job['title']); ?></h2>
    <p><strong>Byudjet:</strong> <?php echo htmlspecialchars($job['budget']); ?> swm</p>
    <p><strong>Deadline:</strong> <?php echo htmlspecialchars($job['deadline']); ?></p>
    <p><strong>Táriyp:</strong> <?php echo htmlspecialchars($job['description']); ?></p>
    <form method="POST">
        <div class="form-group">
            <label for="cover_letter">Cover Letter (Arza xatı)</label>
            <textarea class="form-control" id="cover_letter" name="cover_letter" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Jiberiw</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
