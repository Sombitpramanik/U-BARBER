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
        exit();
    }
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $order_id = $_POST["order_id"];
    $price = $_POST["price"];
    $time = date("Y-m-d H:i:s");
    $time_selected = $_POST["time_slot"];


    $query = "INSERT INTO receive_order VALUES('$time','$name','$mobile','$order_id','$price','$time_selected')";
    $success = mysqli_query($conn, $query);
    if ($success) {
        // If the query was successful, show a success message
        echo '<script>';
        echo 'alert("Order received successfully.");';
        echo 'setTimeout(function() { window.close(); }, 3000);'; // Close the window after 3 seconds
        echo '</script>';
    } else {
        // If there was an error with the query
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="en">
    <meta name="description" content="Welcome to U-BARBER, your destination for top-notch grooming and style services. Our skilled barbers are dedicated to helping you look and feel your best with precision haircuts, traditional shaves, and modern styling. Experience the art of barbering in a relaxed and comfortable atmosphere. Book your appointment today and elevate your style with U-BARBER.">
    <meta name="keywords" content="U-BARBER,online barber, barber, new website, barber shop,https://barber.sombti-server.online">
    <meta name="author" content="Sombit Pramanik">
    <meta property="og:title" content="U-BARBER">
    <meta property="og:description" content="Welcome to U-BARBER, your destination for top-notch grooming and style services. Our skilled barbers are dedicated to helping you look and feel your best with precision haircuts, traditional shaves, and modern styling. Experience the art of barbering in a relaxed and comfortable atmosphere. Book your appointment today and elevate your style with U-BARBER.">
    <meta property="og:image" content="./U-BARBER.png">
    <meta property="og:url" content="https://barber.sombti-server.online">
    <meta property="og:type" content="website">
    <link rel="icon" href="./U-BARBER.ico" type="image/x-icon">
    <title>Review Order / <?php echo ucwords($row["f_name"] . " " . $row["l_name"]); ?></title>
    <style>
        body {
            background: linear-gradient(to bottom, rgb(207, 235, 245), rgb(255, 255, 255));
            margin: 0;
            padding: 0;
            height: 90vh;
            width: 99%;
        }

        .order_form {
            margin: 5px;
        }

        input {
            width: 90%;
            font-weight: bold;
            overflow: hidden;
            border-radius: .3em;
            margin: .5em;
            height: 2em;
            padding: .3em;
            border: 4px solid yellow;
        }

        input::placeholder {
            text-transform: capitalize;

        }

        label {
            text-align: left !important;
            margin-left: .5em;
            margin-right: .5em;
            font-size: large;
            font-weight: bold;
        }

        button {
            margin-top: 2em;
            margin-left: 8.9vw;
            background-color: #2ecc71;
            font-size: large;
            font-weight: bolder;
            color: rgb(55, 54, 60);
            border-radius: .9em;
            border: 3px solid rgb(188, 195, 111);
            padding: .5em;
            width: 80%;
            cursor: pointer;

        }

        a {
            margin: auto;
            color: rgb(49, 14, 175);
            text-decoration: none;
            font-size: large;
            font-weight: bold;
            border-radius: 2em;
            border: 3px solid black;
            padding: 5px 20px 5px 20px;
            background-color: #35d47f;
        }
    </style>

</head>

<body>
    <form action="" method="post" class="order_form">
        <h1>Review Order</h1><br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required value="<?php echo ucwords($row["f_name"] . " " . $row["l_name"]); ?>"><br>
        <label for="mobile">Mobile</label>
        <input type="tel" id="mobile" name="mobile" required value="<?php echo $row["mobile"]; ?>"><br>
        <!-- <label for="time-slot">Select a time slot:</label> -->
        <select id="time-slot" name="time_slot">
            <!-- Option for a default placeholder -->
            <option value="">Select a time slot</option>

            <?php
            require 'config.php';
            $available = mysqli_query($conn, "SELECT bocked_time FROM receive_order");

            if (mysqli_num_rows($available) > 0) {
                $existingTimeSlots = [];

                while ($time_slot = mysqli_fetch_assoc($available)) {
                    // Store existing time slots in an array
                    $existingTimeSlots[] = $time_slot["time_slot"];
                }

                // Create an array of time slots from 7:00 AM to 9:00 PM at 30-minute intervals
                $start = strtotime("07:00 AM");
                $end = strtotime("09:00 PM");
                $interval = 30 * 60; // 30 minutes in seconds
                $current = $start;

                while ($current <= $end) {
                    $timeSlot = date("h:i A", $current);

                    // Check if the time slot exists in the database
                    if (!in_array($timeSlot, $existingTimeSlots)) {
                        echo '<option value="' . $timeSlot . '">' . $timeSlot . '</option>';
                    }

                    $current += $interval;
                }
            } else {
                // If there are no existing time slots, create all options
                $start = strtotime("07:00 AM");
                $end = strtotime("09:00 PM");
                $interval = 30 * 60; // 30 minutes in seconds
                $current = $start;

                while ($current <= $end) {
                    $timeSlot = date("h:i A", $current);
                    echo '<option value="' . $timeSlot . '">' . $timeSlot . '</option>';
                    $current += $interval;
                }
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

        </select>
        <label for="order_id">Order ID</label>
        <input type="text" id="order_id" name="order_id" contenteditable="false" readonly required><br>
        <label for="price">Price</label>
        <input type="text" id="price" name="price" contenteditable="false" readonly required><br>

        <button type="submit" name="submit" id="submit">Order Now</button>
    </form>
    <br>
</body>
<script>
    const closeButton = document.getElementById("closeButton");

    function updateOrderIdField() {
        const orderId = localStorage.getItem("orderId");
        const price = localStorage.getItem("price");


        if (price && document.getElementById("price")) {
            const current_price = document.getElementById("price").value;

            if (price !== current_price) {
                document.getElementById("price").innerText = price;
                document.getElementById("price").value = price;
            }
        }

        if (orderId && document.getElementById("order_id")) {
            const currentOrderId = document.getElementById("order_id").value;

            if (orderId !== currentOrderId) {
                document.getElementById("order_id").innerText = orderId;
                document.getElementById("order_id").value = orderId;
            }
        }
    }
    const updateInterval = setInterval(updateOrderIdField, 100);
</script>

</html>