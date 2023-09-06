<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './PHP/config.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM login_data WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $session_token = $email; // Use email as session token
            $_SESSION["login"] = true;
            $_SESSION["session_token"] = $session_token;
            header("location: index.php");
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('Username or email is not found :(  Register Now!');</script>";
    }
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
    <link rel="icon" href="./IMG/U-BARBER.png" type="image/x-icon">
    <title>Sombit Web Services</title>
    <!-- 
        Website External Page's and Style Link Section
     -->
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/responsive.css">
    <!-- 
        Internal CSS Goes down
    -->

    <style>
    </style>
</head>

<body>
    <img src="./IMG/U-BARBER.png" alt="" srcset=""><br>
    <form action="" method="post" class="login_form">
        <label for="email">What is our Email </label>
        <input type="email" placeholder="please tell me" name="email" id="email" required><br>
        <label for="password">What is your password  </label>
        <input type="password" placeholder="I don't tell anyone" name="password" id="password" required> <br>
        <button type="submit" name="submit" id="login_btn">Log In</button><br>
        <a href="./PHP/register.php">New User ??</a>
    </form>



</body>

</html>