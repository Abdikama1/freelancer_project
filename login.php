<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];

        if ($user['role'] == 'freelancer') {
            header("Location: freelancer/dashboard.php");
        } else {
            header("Location: employer/dashboard.php");
        }
        exit;
    } else {
        $error = "Email or password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: gainsboro;
        }
        .img-fluid {
            object-fit: cover;  
            height: auro;        
            width: 100%;   
            display: block;   
            margin: 0 auto;
            padding: 100px 0;
        }
        .card {
            border-radius: 1rem;
            max-height: 700px; /* Keep the card width */
            margin: 0 auto;   /* Center the card horizontally */
            padding: 15px;     /* Reduce the padding inside the card */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
            height: auto;      /* Set card height to auto or a fixed height (e.g., 400px) */
            min-width: 300px; /* Set the minimum height of the card */
        }

        .card-body {
            padding: 10px; /* Reduce padding inside the card body */
        }

        .card .form-outline {
            margin-bottom: 20px; /* Adjust spacing between form fields */
        }

        .pt-1 {
            margin-top: 10px; /* Reduce margin-top for the submit button section */
        }

        .small {
            font-size: 0.9rem; /* Slightly smaller text for links */
        }
    </style>
</head>
<body>

<section class="vh-100" >
  <div class="container py-5 h-100 background-color: #ff7777">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://img.freepik.com/free-vector/freelancer-concept-illustration_114360-7590.jpg"
                alt="login form" class="img-fluid" style= border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <!-- Form Start -->
                <form method="POST">

                  <!-- Logo and Title -->
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Akkauntqa Kiriw</h5>

                  <!-- Email Field -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example17">Email address</label>
                  </div>

                  <!-- Password Field -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" required />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <!-- Error Message -->
                  <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                  <!-- Submit Button -->
                  <div class="pt-1 mb-1">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                  </div>

                  <!-- Additional Links -->
                  <p class="mb-2 px-2" style="color: navy; font-size: 14px;">Dizimnen ótiw ->>> <a href="register.php"
                      style="color: darkviolet; font-size: 14px;">Registraciya</a></p>

                </form>
                <!-- Form End -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
