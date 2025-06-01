<?php
session_start();
include('../auth.php');
include('../db.php');
if (!isset($_GET['job_id']) || !is_numeric($_GET['job_id'])) {
    die("Qate jumıs IDı");
}
$job_id = (int) $_GET['job_id'];
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = :job_id AND employer_id = :user_id");
$stmt->execute(['job_id' => $job_id, 'user_id' => $user_id]);
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    die("Siz bul jumısqa kiriw huquqına iye emessiz.");
}
$stmt = $pdo->prepare("SELECT a.*, u.name AS freelancer_name, u.id AS freelancer_id 
                       FROM applications a 
                       JOIN users u ON a.freelancer_id = u.id 
                       WHERE a.job_id = :job_id");
$stmt->execute(['job_id' => $job_id]);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
$hasAccepted = false;
foreach ($applications as $app) {
    if ($app['status'] === 'accepted') {
        $hasAccepted = true;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Arzalar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <h2>“<?= htmlspecialchars($job['title']) ?>” vakansiyasına jiberilgen arzalar</h2>

    <?php if (count($applications) === 0): ?>
        <p class="text-muted">Házirshe bul vakansiyaǵa hesh qanday arza jiberilmegen.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Frilanser</th>
                    <th>Arza xatı</th>
                    <th>Status</th>
                    <th>Ámeller</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?= htmlspecialchars($app['freelancer_name']) ?></td>
                        <td><?= nl2br(htmlspecialchars($app['cover_letter'])) ?></td>
                        <td>
                            <?php if ($app['status'] === 'accepted'): ?>
                                <span class="badge badge-success">Qabıllanǵan</span>
                            <?php elseif ($app['status'] === 'rejected'): ?>
                                <span class="badge badge-danger">Biykar etilgen</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Kórip shıǵılıp atır</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($app['status'] === 'pending' && !$hasAccepted): ?>
                                <a href="accept_application.php?app_id=<?= $app['id'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Bul arzanı qabıllayjaqsızba? Basqa arzalar biykar etiledi.')">Qabıllaw</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Jawılǵan</button>
                            <?php endif; ?>

                            <!-- Frilanserga Xabar yuborish tugmasi -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#messageModal<?= $app['freelancer_id'] ?>">Xabar Yuborish</button>
                        </td>
                    </tr>

                    <!-- Modal dialog (Xabar yuborish formasi) -->
                    <div class="modal fade" id="messageModal<?= $app['freelancer_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel<?= $app['freelancer_id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="messageModalLabel<?= $app['freelancer_id'] ?>">Frilanserga Xabar Yuborish</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../send_message.php?receiver_id=<?= $app['freelancer_id'] ?>" method="POST">
                                        <div class="form-group">
                                            <label for="message">Xabar:</label>
                                            <textarea name="message" class="form-control" id="message" rows="4" placeholder="Xabar yozing..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Yuborish</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
