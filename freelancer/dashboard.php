<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
session_start();
include('../auth.php');
include('../db.php');
$query = "SELECT * FROM jobs WHERE status = 'open'";
$result = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Paneli</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-content {
            width: 600px;
            height: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Ashıq vakansiyalar</h2>
    <div class="list-group">
        <?php
        if ($result->rowCount() > 0) {
            while ($job = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
                echo '<h5>' . htmlspecialchars($job['title']) . '</h5>';
                echo '<p>' . htmlspecialchars($job['description']) . '</p>';
                echo '<p><strong>Budjet:</strong> ' . htmlspecialchars($job['budget']) . ' swm</p>';
                echo '<p><strong>Deadline:</strong> ' . htmlspecialchars($job['deadline']) . '</p>';
                
                // Frilanserga Xabar yuborish tugmasi
                if (isset($job['employer_id'])) {
                    // Xabar yuborish uchun Modalni ochish
                    echo '<button class="btn btn-primary" data-toggle="modal" data-target="#messageModal' . $job['id'] . '">Employerga Xabar Yuborish</button>';
                }
                
                echo '<a href="apply.php?job_id=' . $job['id'] . '" class="btn btn-primary">Vakansiyaǵa arza jiberiw</a>';
                echo '</div>';

                // Modalni yaratish
                echo '
                <div class="modal fade" id="messageModal' . $job['id'] . '" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel' . $job['id'] . '" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel' . $job['id'] . '">Xabar Yuborish</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../send_message.php?receiver_id=' . $job['employer_id'] . '" method="POST">
                                    <div class="form-group">
                                        <label for="message">Xabar:</label>
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Xabar yozing..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Yuborish</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-muted">Házirshe ashıq vakansiyalar joq.</p>';
        }
        ?>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Popper.js (Bootstrap uchun zarur) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
