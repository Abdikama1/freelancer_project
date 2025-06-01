<?php
$host = 'localhost';
$dbname = 'freelancer_marketplace';
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database jalǵawda qate: " . $e->getMessage());
}

// Foydalanuvchiga tegishli ishlarni olish uchun funksiya
function get_user_jobs() {
    global $pdo;
    $user_id = $_SESSION['user']['id']; // Ish beruvchi ID
    $stmt = $pdo->prepare("SELECT id, title FROM jobs WHERE employer_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
