<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';

if (!empty($_SESSION["session_token"])) {
    $session_token = $_SESSION["session_token"];
    $email = $session_token;

    $result = mysqli_query($conn, "SELECT * FROM sysadmin WHERE email = '$email'");
    $admin_row = mysqli_fetch_assoc($result);

    if (!$admin_row) {
        header("location: index.php"); // Invalid session token, redirect to login
    }
} else {
    header("location: index.php"); // No session token, redirect to login
}

$user = mysqli_query($conn, "SELECT * FROM normal_user");
$user_row = mysqli_fetch_assoc($user);

?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="./admin.css">
    <title>U-BARBER ADMIN</title>
    <style>
        .spical {
            height: max-content;
            overflow-wrap: break-word;
            max-width: 80%;
        }

        .spical>td {
            padding: 0;
            margin: 0;
        }
    </style>
    <script>
        // Function to reload the page
        function reloadPage() {
            location.reload(); // Reload the current page
        }

        // Set a timeout to reload the page every 5 minutes (adjust as needed)
        setTimeout(reloadPage, 600000); // 10 minutes in milliseconds (10 * 60 * 1000)
    </script>
</head>

<body>
    <header>
        <h1>Welcome U-Barber ADMIN <br><br><a href="./logout.php">Logout</a><br></h1>
    </header>
    <fieldset>
        <legend>Today's Order</legend>
        <?php
        // Get today's date in the same format as the database date
        $todayDate = date("Y-m-d");

        // Query to fetch orders for today's date
        $order = mysqli_query($conn, "SELECT * FROM receive_order WHERE DATE(time_stamp) = '$todayDate'");

        if (mysqli_num_rows($order) > 0) {
            while ($row = mysqli_fetch_assoc($order)) {
                echo '<table>';
                echo '<thead>';
                echo '<th>Data</th>';
                echo '<th>Information</th>';
                echo '<th>Operation</th>';
                echo '</thead>';
                echo '<tbody>';

                echo '<tr>';
                echo '<td>Name</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>Mobile</td>';
                echo '<td>' . $row["mobile"] . '</td>';
                echo '<td></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>Order ID</td>';
                echo '<td>' . $row["order_id"] . '</td>';
                echo '<td><a href="https://wa.me/' . $row["mobile"] . '" target="_blank">Chat in <br><i>Whatsapp</i></a></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>Price:</td>';
                echo '<td>' . $row["price"] . '</td>';
                echo '<td></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>Style</td>';
                $check_img = $row["order_id"];
                $mb = $row["mobile"];
                $upp = $mb . $check_img;

                // Check if the image file exists in the ./img/ directory
                $imgPath = "./img/$check_img.png";
                if (file_exists($imgPath)) {
                    echo '<td><img src="' . $imgPath . '" alt="' . $check_img . '"></td>';
                } else {
                    // Check if the image file exists in the ./uploads/ directory
                    $uploadPath = "./uploads/$upp.png";
                    if (file_exists($uploadPath)) {
                        echo '<td><img src="' . $uploadPath . '" alt="' . $check_img . '"></td>';
                    } else {
                        // Handle the case where the image file doesn't exist in either directory
                        echo '<td>No image available</td>';
                    }
                }
                echo '<td></td>';
                echo '</tr>';

                echo '<tr>';
                echo '<td>Time : </td>';
                echo '<td>' . $row["bocked_time"] . '</td>';
                echo '<td></td>';
                echo '</tr>';

                echo '<tbody>';
                echo '</table>';
                echo '<br>';
            }
        } else {
            echo "No orders placed today";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Update Catalog & Insert New</legend>
        <?php
        $print_img_table = mysqli_query($conn, "SELECT * FROM order_id_price");
        echo '<table>';
        echo '<thead>';
        echo '<th>Price</th>';
        echo '<th>style</th>';
        echo '<th>operation</th>';
        echo '</thead>';
        echo '<tbody>';
        while ($data = mysqli_fetch_assoc($print_img_table)) {
            echo '<tr>';
            echo '<td>' . $data["price"] . '<br><br>' . $data["order_id"] . '</td>';
            echo '<td><img src="./img/' . $data["order_id"] . '.png" alt="' . $data["order_id"] . '"></td>';
            echo '<td class="t2"><a class="openBTN" data-order-id="' . $data["order_id"] . '" price="' . $data["price"] . '">update</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        ?>
        <div><a class="openBTN3">Insert New Item</a></div>
        <div id="popup" class="popup">
            <div class="popup-content">
                <iframe src="./update_ctl.php" width="99%" height="100%" style="border-radius: 5px;"></iframe>
                <span class="close" id="closeButton">&times;</span>
            </div>
        </div>
        <div id="popup3" class="popup3">
            <div class="popup-content3">
                <iframe src="./insert.php" width="99%" height="100%" style="border-radius: 5px;"></iframe>
                <span class="close3" id="closeButton3">&times;</span>
            </div>
        </div>
        <script>
            const openButtons3 = document.getElementsByClassName("openBTN3");
            const closeButton3 = document.getElementById("closeButton3");
            const popup3 = document.getElementById("popup3");
            for (let i = 0; i < openButtons3.length; i++) {
                openButtons3[i].addEventListener("click", function() {
                    popup3.style.display = "block";
                });
            }

            // Function to close the popup
            closeButton3.addEventListener("click", function() {
                // localStorage.removeItem("orderId");
                popup3.style.display = "none";
            });
            const openButtons = document.getElementsByClassName("openBTN");
            const closeButton = document.getElementById("closeButton");
            const popup = document.getElementById("popup");
            for (let i = 0; i < openButtons.length; i++) {
                openButtons[i].addEventListener("click", function() {
                    const orderId = this.getAttribute("data-order-id");
                    const price = this.getAttribute("price")

                    // Store the orderId in local storage
                    localStorage.setItem("orderId", orderId);
                    localStorage.setItem("price", price);

                    // Display the popup
                    popup.style.display = "block";
                });
            }

            // Function to close the popup
            closeButton.addEventListener("click", function() {
                // localStorage.removeItem("orderId");
                popup.style.display = "none";
            });
        </script>
    </fieldset>
    <fieldset>
        <legend>Update the Business Information</legend>
        <?php
        $business_info = mysqli_query($conn, "SELECT * FROM business_info");
        $b_info_data = mysqli_fetch_assoc($business_info);

        echo '<table class="spical">';
        echo '<thead>';
        echo '<th>data</th>';
        echo '<th>Current</th>';
        echo '<th>operation</th>';
        echo '</thead>';
        echo '<tbody>';

        // Row: Name
        echo '<tr>';
        echo '<td>name</td>';
        echo '<td>' . $b_info_data["b_name"] . '</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: Mobile
        echo '<tr>';
        echo '<td>mobile</td>';
        echo '<td>' . $b_info_data["mobile"] . '</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: Logo
        echo '<tr>';
        echo '<td>logo</td>';
        echo '<td><img src="./' . $b_info_data["logo"] . '" alt="Business Logo" srcset=""></td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: Tag Line
        echo '<tr>';
        echo '<td>tag line</td>';
        echo '<td>" . $b_info_data["tagline"] . "</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: instagram
        echo '<tr>';
        echo '<td>mobile</td>';
        echo '<td>' . $b_info_data["instagram"] . '</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: facebook
        echo '<tr>';
        echo '<td>mobile</td>';
        echo '<td>' . $b_info_data["facebook"] . '</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        // Row: Opening & Closing Time
        echo '<tr>';
        echo '<td>opening & closing time</td>';
        echo '<td>' . $b_info_data["openTime"] . ' to ' . $b_info_data["closeTime"] . '</td>';
        echo '<td class="t2"><a class="openBTN2">update</a></td>';
        echo '</tr>';

        echo '</tbody>';
        echo '</table>';
        ?>
        <div id="popup2" class="popup2">
            <div class="popup-content2">
                <iframe src="./update_business.php" width="99%" height="100%" style="border-radius: 5px;"></iframe>
                <span class="close2" id="closeButton2">&times;</span>
            </div>
        </div>
        <script>
            const openButtons2 = document.getElementsByClassName("openBTN2");
            const closeButton2 = document.getElementById("closeButton2");
            const popup2 = document.getElementById("popup2");
            for (let i = 0; i < openButtons2.length; i++) {
                openButtons2[i].addEventListener("click", function() {
                    // Display the popup
                    popup2.style.display = "block";
                });
            }

            // Function to close the popup
            closeButton2.addEventListener("click", function() {
                popup2.style.display = "none";
            });
        </script>
    </fieldset>
    <fieldset>
        <?php
        // Fetch data from the database for the last 30 days
        $currentDate = date("Y-m-d H:i:s");
        $thirtyDaysAgo = date("Y-m-d H:i:s", strtotime("-30 days"));

        $filteredOrders = mysqli_query($conn, "SELECT * FROM receive_order WHERE time_stamp BETWEEN '$thirtyDaysAgo' AND '$currentDate'");

        // Calculate total customer count and total income for the last 30 days
        $totalCustomers = mysqli_num_rows($filteredOrders);
        $totalIncome = 0;

        while ($order = mysqli_fetch_assoc($filteredOrders)) {
            $totalIncome += intval($order["price"]);
        }

        // Fetch data for the last 7 days
        $sevenDaysAgo = date("Y-m-d H:i:s", strtotime("-7 days"));
        $filteredOrdersSevenDays = mysqli_query($conn, "SELECT * FROM receive_order WHERE time_stamp BETWEEN '$sevenDaysAgo' AND '$currentDate'");

        // Calculate the total income for the last 7 days
        $totalIncomeSevenDays = 0;

        while ($order = mysqli_fetch_assoc($filteredOrdersSevenDays)) {
            $totalIncomeSevenDays += intval($order["price"]);
        }
        ?>

        <legend>Revenue</legend>
        <fieldset>
            <legend>This Month</legend>
            <table>
                <thead>
                    <th>data</th>
                    <th>information</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Total <br> customer</td>
                        <td><?php echo $totalCustomers; ?></td>
                    </tr>
                    <tr>
                        <td>Paste 7 day <br> income</td>
                        <td><?php echo $totalIncomeSevenDays; ?></td>
                    </tr>
                    <tr>
                        <td>Total (7 Days) </td>
                        <td><?php echo $totalIncome; ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <?php
        // Fetch data from the database for the lifetime
        $lifetimeOrders = mysqli_query($conn, "SELECT * FROM receive_order");

        // Calculate total customer count and total income for the lifetime
        $totalCustomersLifetime = mysqli_num_rows($lifetimeOrders);
        $totalIncomeLifetime = 0;

        while ($order = mysqli_fetch_assoc($lifetimeOrders)) {
            $totalIncomeLifetime += intval($order["price"]);
        }

        // Fetch data for the last 3 months
        $threeMonthsAgo = date("Y-m-d H:i:s", strtotime("-3 months"));
        $filteredOrdersThreeMonths = mysqli_query($conn, "SELECT * FROM receive_order WHERE time_stamp >= '$threeMonthsAgo'");

        // Calculate the total income for the last 3 months
        $totalIncomeThreeMonths = 0;

        while ($order = mysqli_fetch_assoc($filteredOrdersThreeMonths)) {
            $totalIncomeThreeMonths += intval($order["price"]);
        }
        ?>

        <fieldset>
            <legend>Lifetime</legend>
            <table>
                <thead>
                    <th>data</th>
                    <th>information</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Total <br> customer</td>
                        <td><?php echo $totalCustomersLifetime; ?></td>
                    </tr>
                    <tr>
                        <td>3 month <br> income</td>
                        <td><?php echo $totalIncomeThreeMonths; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><?php echo $totalIncomeLifetime; ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

    </fieldset>

</body>

</html>