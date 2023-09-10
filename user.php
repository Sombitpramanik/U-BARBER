<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';


if (!empty($_SESSION["session_token"])) {
    $session_token = $_SESSION["session_token"];
    $email = $session_token;

    $result = mysqli_query($conn, "SELECT * FROM normal_user WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("location: index.php"); // Invalid session token, redirect to login
    }
} else {
    header("location: index.php"); // No session token, redirect to login
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="en">
    <meta name="description" content="Discover reliable server and hosting solutions tailored to your needs at [Your Website Name]. We specialize in delivering cutting-edge hosting services, including shared, VPS, and dedicated hosting, ensuring your website's optimal performance. Take advantage of our expertise in custom server configurations, allowing you to build a server environment that perfectly matches your business requirements. Additionally, we offer advanced storage solutions, empowering you with scalable and secure data management. Explore our range of cost-effective plans and enhance your online presence with seamless server solutions">
    <meta name="keywords" content="web services, amazon web services, server,sql server,free website hosting, free domain and hosting, hosting, development server, sombit web services,https://hosting.sombti-server.online,">
    <meta name="author" content="Sombit Pramanik">
    <meta property="og:title" content="Sombit Web Services">
    <meta property="og:description" content="Discover reliable server and hosting solutions tailored to your needs at Sombit Web Services. We specialize in delivering cutting-edge hosting services, including shared, VPS, and dedicated hosting, ensuring your website's optimal performance. Take advantage of our expertise in custom server configurations, allowing you to build a server environment that perfectly matches your business requirements. Additionally, we offer advanced storage solutions, empowering you with scalable and secure data management. Explore our range of cost-effective plans and enhance your online presence with seamless server solutions.">
    <meta property="og:image" content="/image/sws.png">
    <meta property="og:url" content="https://hosting.sombti-server.online">
    <meta property="og:type" content="website">
    <link rel="icon" href="./U-BARBER.ico" type="image/x-icon">
    <title>U-BARBER / <?php echo ucwords($row["f_name"] . " " . $row["l_name"]); ?></title>
    <style>

    </style>
    <link rel="stylesheet" href="./user.css">
</head>

<body>
    <header>
        <div class="user_info">
            <h3>👋 Welcome <?php echo ucwords($row["f_name"] . " " . $row["l_name"]); ?></h3>

            <!-- <img src="./U-BARBER.png" alt="" srcset=""> -->
            <div class="hed" style="display: flex;">
                <div class="cont">
                    <span><a style="padding-right: 2.1em;" href="https://wa.me/6297037940">Contact Owner</a><br><br><a href="./custom.php">Custom Order</a><br><br><a href="./logout.php">log out</a> </span><br><br>
                </div>
                <div class="im">
                    <img src="./U-BARBER.png" alt="">
                </div>
            </div>

            <i><span style="font-family: Arial, Helvetica, sans-serif;">We're thrilled to have you here and ready to help you look your best. Whether you're in need of a fresh haircut, a clean shave, or a complete makeover, our skilled barbers are here to make you feel like a million bucks 💇‍♂️.Relax, unwind, and enjoy our top-notch grooming services in a welcoming and stylish atmosphere. Your satisfaction is our top priority, and we take pride in every cut and style we create.Explore our services, meet our talented barbers, and book your appointment today. Get ready to elevate your style and confidence with us! 💪
                    <br><br> <b> Let's make you look sharp and feel fantastic. See you soon! </i>😊✨</b></span>
            <div id="recent_order">
                <h2>Recent Orders</h2>
                <div class="order">
                    <li class="list">
                        <div class="image">
                            <img src="./U-BARBER.png" alt="" srcset="">
                        </div>
                        <div class="con_order" style="padding: 5px;">
                            <br><a class="con_b" href="">Order Now</a><br><br>
                            <a class="con_b" href="">Feedback</a><br><br>
                            <a class="con_b" href="">Share</a><br>
                        </div>
                    </li>
                    <li class="list">
                        <div class="image">
                            <img src="./U-BARBER.png" alt="" srcset="">

                        </div>
                        <div class="con_order" style="padding: 5px;">
                            <br><a class="con_b" href="">Order Now</a><br><br>
                            <a class="con_b" href="">Feedback</a><br><br>
                            <a class="con_b" href="">Share</a><br>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="order">
            <li class="list1">
                <div class="image1">
                    <img src="./U-BARBER.png" alt="" srcset="">
                </div>
                <div class="con" style="margin:5px;">
                    <br><a class="openBTN">Order Now</a><br><br>
                    <a class="con_a" href="">Feedback</a><br><br>
                    <a class="con_a" href="">Share</a><br>
                </div>
            </li>
            <div class="image1">
                <img src="./U-BARBER.png" alt="" srcset="">
            </div>
            <div class="con" style="margin:5px;">
                <br><a class="openBTN">Order Now</a><br><br>
                <a class="con_a" href="">Feedback</a><br><br>
                <a class="con_a" href="">Share</a><br>
            </div>
            </li>
        </div>
        <div class="order">
            <li class="list1">
                <div class="image1">
                    <img src="./U-BARBER.png" alt="" srcset="">
                </div>
                <div class="con" style="margin:5px;">
                    <br><a class="openBTN">Order Now</a><br><br>
                    <a class="con_a" href="">Feedback</a><br><br>
                    <a class="con_a" href="">Share</a><br>
                </div>
            </li>
            <div class="image1">
                <img src="./U-BARBER.png" alt="" srcset="">
            </div>
            <div class="con" style="margin:5px;">
                <br><a class="openBTN">Order Now</a><br><br>
                <a class="con_a" href="">Feedback</a><br><br>
                <a class="con_a" href="">Share</a><br>
            </div>
            </li>
        </div>
        <div class="order">
            <li class="list1">
                <div class="image1">
                    <img src="./U-BARBER.png" alt="" srcset="">
                </div>
                <div class="con" style="margin:5px;">
                    <br><a class="openBTN">Order Now</a><br><br>
                    <a class="con_a" href="">Feedback</a><br><br>
                    <a class="con_a" href="">Share</a><br>
                </div>
            </li>
            <div class="image1">
                <img src="./U-BARBER.png" alt="" srcset="">
            </div>
            <div class="con" style="margin:5px;">
                <br><a class="openBTN">Order Now</a><br><br>
                <a class="con_a" href="">Feedback</a><br><br>
                <a class="con_a" href="">Share</a><br>
            </div>
            </li>
        </div>
    </main>
    <div id="popup" class="popup">
        <div class="popup-content">
            <iframe src="./order.php" width="80%" height="100%"></iframe>
            <span class="close" id="closeButton">&times;</span>
        </div>
    </div>
    <footer>
        <div class="logo">
            <img src="./U-BARBER.png" alt="">

        </div>
        <div class="links">
            <li> <a href="https://wa.me/6297037940" target="_blank">>> Our Developer</a></li> <br>
            <li> <a href="" target="_blank">>> Site Owner</a></li> <br>
            <li> <a href="" target="_blank">>> Facebook</a></li> <br>
            <li> <a href="" target="_blank">>> Instagram</a></li> <br>
            <li> <a href="" target="_blank">>> Whatsapp</a></li> <br>

        </div>
    </footer>
    <script src="./script.js"></script>
</body>

</html>
