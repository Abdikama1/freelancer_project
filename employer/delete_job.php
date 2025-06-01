<?php
session_start();
include('../auth.php');
include('../db.php');
$job_id = $_GET['job_id'] ?? null;
if (!$job_id) {
    echo "<p class='text-danger'>Vakansiya IDı tabılmadı!</p>";
    exit();
}
$query = "DELETE FROM jobs WHERE id = :job_id AND employer_id = :employer_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->bindParam(':employer_id', $_SESSION['user']['id']);
$stmt->execute();
header('Location: dashboard.php');
exit();
?>
