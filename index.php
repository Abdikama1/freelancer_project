<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer hám Jumıs beriwshiler bazarı</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <style>
        body {
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .hero-section {
            background-color: black;
            min-height: 100vh;
            color: white;
            text-align: center;
            position: relative;
        }
        .img-style {
            min-height: 100vh;
            width: 100%;
            display: block;
            align-items: center;
            justify-content: center;
            position: absolute;
            background-repeat: no-repeat;
            background-size: cover;
            clip-path: inset(70px 0 70px 0); /* Top 70px and bottom 70px will be clipped */
            top:-70px;
        }
        .card-container {
            position: absolute;
            color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 800px;
            width: 90%;
        }
        .card-deck {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between; /* Cards distributed with spacing */
        }
        .big-card{
            padding: 20px;
            background-color: black;
            opacity: 0.80;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: white;
        }
        .big-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .col {
            display: flex;          /* Flex konteyneri */
            flex-wrap: wrap;        /* Kartalar qatorlarga o'tishi uchun */
            gap: 20px;              /* Yalnız vertikal va gorizontal bo'shliq 20px */
        }

        .card {
            background-color: whitesmoke;
            opacity: 0.8;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px black;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 300px;           /* Fixed card width */
            color: black;
        }
        .card-body {
            padding: 30px;
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
        }
        .card-body h5, .card-body p {
            color: white;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card-body p {
            font-size: 14px;
        }
         .btn-info {
            background: none;
            border-color: blue;
            color: white;
            transition-duration: 0.4s;
        }
        .btn-info:hover {
            color: blue;
            background: #f4f7fc;
        }
        .btn-success {
            background-color: black;
            color: gainsboro;
            transition-duration: 0.4s;
        }
        .btn-success:hover {
            background-color: whitesmoke;
            color: blue;
        }
        .btn-light {
            background-color: darkorchid;  
        }
        .footer {
            background-color: #f8f9fa;
            padding: 40px 0;
            text-align: center;
        }

        .footer .footer-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer .footer-links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        .footer .footer-links a:hover {
            text-decoration: underline;
        }

        .footer .footer-social a {
            margin: 0 10px;
            font-size: 18px;
            color: #333;
        }

        .footer .footer-social a:hover {
            color: #007bff;
        }

        .footer .footer-bottom {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }



        /* Footer styles */
        .footerbottom {
            background-color: #222;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
        }
        .footerbottom p {
            margin: 0;
        }
    </style>
</head>
<body>

<section class="hero-section">
    <img class="img-style" src="JOB.png" alt="Background image for job portal">
    <div class="card-container">
        <div class="big-card" style="max-width: 1000px; margin: 0 auto;">
            <div class="card-body text-center">
                <h1 class="display-4">Freelancer hám Jumıs beriwshiler bazarı</h1>
                <p class="lead">Biziń platformamızda Freelancer hám Jumıs beriwshilerdi ańsat tawıń hám jumıs isleń!</p>
                <a href="login.php" class="btn btn-info btn-lg mx-2 px-5 py-2">
                    <i class="fas fa-sign-in-alt"></i> Kiriw
                </a>
                <a href="register.php" class="btn btn-success btn-lg mx-2 px-5 py-2">
                    <i class="fas fa-user-plus"></i> Dizimnen ótiw
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Vakansiya -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Вакансии дня</h5>
                    <p class="card-text">3 000 000 – 15 000 000 so'm</p>
                    <p class="card-text">14 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Компании -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Компании дня</h5>
                    <p class="card-text">296 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Work from home -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Работа из дома</h5>
                    <p class="card-text">611 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Подработка -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Подработка</h5>
                    <p class="card-text">до 55 440 900 so'm</p>
                    <p class="card-text">729 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Курьер -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Курьер</h5>
                    <p class="card-text">1 947 100 – 27 746 000 so'm</p>
                    <p class="card-text">70 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Водитель -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Водитель</h5>
                    <p class="card-text">1 293 700 – 24 416 600 so'm</p>
                    <p class="card-text">177 vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Продавец -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Продавец</h5>
                    <p class="card-text">до 12 875 300 so'm</p>
                    <p class="card-text">342 Vakansiya</p>
                </div>
            </div>
        </div>
        <!-- Кассир -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Kassir</h5>
                    <p class="card-text">7 600 – 8 334 900 so'm</p>
                    <p class="card-text">176 vakansiya</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main content goes here -->

<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="footer-title">
            <h2>Новости и Статьи</h2>
        </div>
        <div class="footer-links">
            <a href="#">Авторазбор откликов с чат-ботом</a>
            <a href="#">Соискатели на HeadHunter</a>
            <a href="#">Отклик из чата</a>
            <a href="#">8 ответов на 8 вопросов</a>
        </div>
        <div class="footer-title mt-4">
            <h3>Статьи</h3>
        </div>
        <div class="footer-links">
            <a href="#">Успешное собеседование: 15 проверенных лайфхаков</a>
            <a href="#">Техническое задание: зачем нужно</a>
            <a href="#">Как составить резюме</a>
            <a href="#">Что писать о себе в резюме</a>
            <a href="#">Как составить мотивационное письмо</a> <!-- New article link -->
        </div>
        <div class="footer-title mt-4">
            <h3>Работа по профессиям</h3>
        </div>
        <div class="footer-links">
            <a href="#">Для программистов</a>
            <a href="#">Для бухгалтеров</a>
            <a href="#">Для инженеров</a>
            <a href="#">Для менеджеров по продажам</a>
            <a href="#">Для директоров</a>
            <a href="#">Для администраторов</a>
            <a href="#">Для маркетологов</a>
            <a href="#">Для дизайнеров</a>
            <a href="#">Для юристов</a>
            <a href="#">Для секретарей</a>
        </div>
        
        <!-- New Section: Контакты -->
        <div class="footer-title mt-4">
            <h3>Контакты</h3>
        </div>
        <div class="footer-links">
            <a href="#">О нас</a>
            <a href="#">Контактная информация</a>
            <a href="#">Часто задаваемые вопросы</a> <!-- New link added -->
        </div>
        
        <div class="footer-social mt-4">
            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a> <!-- New social media link -->
        </div>
        <div class="footer-bottom mt-4">
            <p>&copy; 2025 Freelancer Marketplace. Все права защищены.</p>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footerbottom">
    <p>&copy; 2025 Freelancer Bazarı. All rights reserved.</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
