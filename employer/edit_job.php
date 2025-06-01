<?php
session_start();
include('../auth.php');
include('../db.php');
$job_id = $_GET['job_id'] ?? null;
if (!$job_id) {
    echo "<p class='text-danger'>Vakansiya IDı tabılmadı!</p>";
    exit();
}
$query = "SELECT * FROM jobs WHERE id = :job_id AND employer_id = :employer_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->bindParam(':employer_id', $_SESSION['user']['id']);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    echo "<p class='text-danger'>Vakansiya tabılmadı yamasa sizde huquq joq.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];
    $updateQuery = "UPDATE jobs SET title = :title, description = :description, budget = :budget, deadline = :deadline WHERE id = :job_id";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':deadline', $deadline);
    $stmt->bindParam(':job_id', $job_id);
    $stmt->execute();

    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vakansiyanı ózgertiw</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('header.php');?>

<div class="container mt-4">
    <h2>Vakansiyanı ózgertiw</h2>
    
    <form method="POST" action="edit_job.php?job_id=<?php echo $job_id; ?>">
        <div class="form-group">
            <label for="title">Vakansiya atı</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Jumıs haqqında</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($job['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="budget">Byudjet</label>
            <input type="number" class="form-control" id="budget" name="budget" value="<?php echo htmlspecialchars($job['budget']); ?>" required>
        </div>
        <div class="form-group">
            <label for="deadline">Múddet</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo htmlspecialchars($job['deadline']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Vakansiyanı jańalaw</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
