<?php
session_start();
include('../auth.php');
include('../db.php');
$user_id = $_SESSION['user']['id'];
$query = "SELECT applications.*, jobs.title, jobs.budget, jobs.deadline 
          FROM applications 
          JOIN jobs ON applications.job_id = jobs.id 
          WHERE applications.freelancer_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meniń arzalarım</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-4">
    <h2>Meniń arzalarım</h2>
    <?php if (empty($applications)): ?>
        <div class="alert alert-warning text-center">
            <h4 class="alert-heading">Arzalar joq!</h4>
            <p>Siz ele arza bermegensiz. Iltimas, vakansiyalardı kórip shıǵıp, arza jiberiń.</p>
            <a href="dashboard.php" class="btn btn-primary">Vakansiyalarǵa ótiw</a>
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Atı</th>
                    <th>Byudjet</th>
                    <th>Waqıt shegarası</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['title']); ?></td>
                        <td><?php echo htmlspecialchars($application['budget']); ?> swm</td>
                        <td><?php echo htmlspecialchars($application['deadline']); ?></td>
                        <td>
                            <?php
                            if ($application['status'] == 'pending') {
                                echo "<span class='badge badge-warning'>Kútilmekte</span>";
                            } elseif ($application['status'] == 'accepted') {
                                echo "<span class='badge badge-success'>Qabıllandı</span>";
                            } elseif ($application['status'] == 'rejected') {
                                echo "<span class='badge badge-danger'>Biykar qılındı</span>";
                            }
                            ?>
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
