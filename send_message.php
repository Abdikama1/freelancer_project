<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ma'lumotlar bazasiga ulanish
include('../db.php'); // db.php faylini chaqirish

// Xatolikni tekshirish
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sessiyadagi sender_id ni olish
    $sender_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    if ($sender_id === null) {
        die("Xatolik: Foydalanuvchi tizimga kirgan emas.");
    }

    // To'g'ri ma'lumotlar kiritilganligini tekshirish
    if (isset($_POST['receiver_id'], $_POST['message_text'], $_POST['job_id'])) {
        $receiver_id = $_POST['receiver_id']; // Qabul qiluvchi ID
        $message_text = $_POST['message_text']; // Xabar matni
        $job_id = $_POST['job_id']; // Ish ID (job_id)
        $employer_id = $_SESSION['user']['id']; // Ish beruvchi ID (bu foydalanuvchidan olinadi)

        // SQL so'rovini tayyorlash
        $sql = "INSERT INTO messages (sender_id, receiver_id, message_text, job_id, employer_id, timestamp) 
                VALUES (?, ?, ?, ?, ?, NOW())";

        // Prepared statement yaratish
        if ($stmt = $pdo->prepare($sql)) {
            // Parametrlarni bog'lash
            $stmt->bind_param("iisii", $sender_id, $receiver_id, $message_text, $job_id, $employer_id);

            // So'rovni bajarish
            if ($stmt->execute()) {
                echo "Xabar muvaffaqiyatli yuborildi!";
            } else {
                echo "Xatolik: " . $stmt->error;
            }

            // Prepared statementni yopish
            $stmt->close();
        } else {
            echo "Xatolik: " . $conn->error;
        }
    } else {
        echo "Iltimos, barcha maydonlarni to'ldiring!";
    }
}

// Yopish
$conn->close();
?>

<!-- Xabar yuborish formasi -->
<form action="send_message.php" method="post">
    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user']['id']; ?>">

    <div>
        <label for="receiver_id">Qabul qiluvchi:</label>
        <select name="receiver_id" id="receiver_id" required>
            <?php
            // Foydalanuvchilar ro'yxatini olish
            $users = get_users(); // Bu funksiya siz yozishingiz kerak
            foreach ($users as $user) {
                echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            ?>
        </select>
    </div>

    <div>
        <label for="job_id">Ish:</label>
        <select name="job_id" id="job_id" required>
            <?php
            // Foydalanuvchiga tegishli ishlar ro'yxatini olish
            $jobs = get_user_jobs(); // Bu funksiyani yozishingiz kerak
            foreach ($jobs as $job) {
                echo '<option value="'.$job['id'].'">'.$job['title'].'</option>';
            }
            ?>
        </select>
    </div>

    <div>
        <label for="message_text">Xabar matni:</label>
        <textarea name="message_text" id="message_text" required></textarea>
    </div>

    <button type="submit">Xabarni yuborish</button>
</form>
