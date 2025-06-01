$query = "SELECT m.*, j.title AS job_title, u.name AS sender_name 
          FROM messages m
          JOIN jobs j ON m.job_id = j.id
          JOIN users u ON m.sender_id = u.id
          WHERE m.receiver_id = :user_id OR m.sender_id = :user_id
          ORDER BY m.timestamp DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($message = $result->fetch_assoc()) {
    echo "<div class='message'>";
    echo "<p><strong>" . htmlspecialchars($message['sender_name']) . " (" . htmlspecialchars($message['job_title']) . "):</strong> " . nl2br(htmlspecialchars($message['message_text'])) . "</p>";
    echo "<p><i>Yuborilgan: " . $message['timestamp'] . "</i></p>";
    echo "</div>";
}
