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
    header("location: index.php"); 
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
        /* Hide the hidden content by default */
        .hid_con {
            display: none;
        }

        /* Style the "Read More" button */
        .read-more-button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .read-more-button.less {
            background-color: #e74c3c;
        }
    </style>
    <link rel="stylesheet" href="./user.css">
</head>

<body>
    <header>
        <div class="user_info">
            <h3>👋 Welcome <?php echo ucwords($row["f_name"] . " " . $row["l_name"]); ?></h3>
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
        <div class="show_con">
            <h2><b><i>Recommended Collections</i></b></h2>
            <div class="order">
                <li class="list1">
                    <div class="image1">
                        <img src="./img/6.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB001" price="100">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>
                <li class="list1">
                    <div class="image1">
                        <img src="./img/3.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB002" price="101">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>

            </div>
            <button class="read-more-button">Read More</button>
        </div>
        <div class="hid_con">
            <div class="order">
                <li class="list1">
                    <div class="image1">
                        <img src="./img/2.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB003" price="103">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>
                <li class="list1">
                    <div class="image1">
                        <img src="./img/4.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB004" price="104">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>

            </div>
            <div class="order">
                <li class="list1">
                    <div class="image1">
                        <img src="./img/5.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB005" price="105">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>
                <li class="list1">
                    <div class="image1">
                        <img src="./img/hearcut1.png" alt="" srcset="">
                    </div>
                    <div class="con" style="margin:5px;">
                        <br><a class="openBTN" data-order-id="UB006" price="106">Order Now</a><br><br>
                        <a class="con_a" href="whatsapp://send?text=Go%and%20checkout%The%20Beautiful%20Online%20Hear%20Cutting%20Website%20https://barber.sombti-server.online" target="_blank">Share With Friends <span class="share">&#x1F4E2;</span></a><br>
                    </div>
                </li>

            </div>
        </div>
        <h2></h2>
    </main>
    <div id="popup" class="popup">
        <div class="popup-content">
            <iframe src="./order.php" width="90%" height="100%" ></iframe>
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