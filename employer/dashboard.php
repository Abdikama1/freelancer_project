<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../auth.php');
include('../db.php');
$user_id = $_SESSION['user']['id'];
$query = "SELECT * FROM jobs WHERE employer_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php');?>

<div class="container mt-4">
    <h2>Meniń vakansiyalarım</h2>
    <?php if (empty($jobs)): ?>
        <div class="alert alert-warning text-center">
            <h4 class="alert-heading">Vakansiya qosılmaǵan!</h4>
            <p>Siz ele heshqanday vakansiya qospaǵansız. Iltimas, jańa vakansiya qosıń.</p>
            <a href="post_job.php" class="btn btn-primary">Jańa vakansiya qosıw</a>
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Atı</th>
                    <th>Byudjet</th>
                    <th>Waqıt shegarası</th>
                    <th>Arzalar</th>
                    <th>Ámeller</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($job['title']); ?></td>
                        <td><?php echo htmlspecialchars($job['budget']); ?> swm</td>
                        <td><?php echo htmlspecialchars($job['deadline']); ?></td>
                        <td><a href="job_applications.php?job_id=<?php echo $job['id']; ?>" class="btn btn-info btn-sm">Arzalar</a></td>
                        <td>
                            <a href="edit_job.php?job_id=<?php echo $job['id']; ?>" class="btn btn-warning btn-sm">Ózgertiriw</a>
                            <a href="delete_job.php?job_id=<?php echo $job['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Vakansiyanı óshiriwdi qaleysiz be?')">Óshiriw</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>