<?php
session_start();
include('../auth.php');
include('../db.php');
if (!isset($_GET['app_id']) || !is_numeric($_GET['app_id'])) {
    die("Qate arza IDı");
}
$app_id = (int) $_GET['app_id'];
$stmt = $pdo->prepare("SELECT a.*, j.employer_id, j.id AS job_id 
                       FROM applications a 
                       JOIN jobs j ON a.job_id = j.id 
                       WHERE a.id = :app_id");
$stmt->execute(['app_id' => $app_id]);
$application = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$application || $application['employer_id'] != $_SESSION['user']['id']) {
    die("Sizde bul ámeldi islew imkaniyatı joq.");
}
$job_id = $application['job_id'];
try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE applications SET status = 'accepted' WHERE id = :app_id");
    $stmt->execute(['app_id' => $app_id]);
    $stmt = $pdo->prepare("UPDATE applications SET status = 'rejected' WHERE job_id = :job_id AND id != :app_id");
    $stmt->execute(['job_id' => $job_id, 'app_id' => $app_id]);
    $stmt = $pdo->prepare("UPDATE jobs SET status = 'close' WHERE id = :job_id");
    $stmt->execute(['job_id' => $job_id]);
    $pdo->commit();
    header("Location: job_applications.php?job_id=" . $job_id);
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    die("Qatelik júz berdi: " . $e->getMessage());
}
