<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
</head>

<?php
        include_once('dashboard.php');
        include_once('../register/connection.php');

        session_start();
        $userId = $_SESSION['user_id']; 
        $selectQuery = "SELECT fake_user FROM register WHERE id = '$userId'"; 
        $selectExe = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($selectExe);
        $_SESSION['fake_user'] = $row['fake_user'];
    ?>

        <?php
    if (isset($_SESSION['user_name'])) {
        $userName = $_SESSION['user_name'];
        $userType = $_SESSION['role'];
        $fakeUser = $_SESSION['fake_user'];
        // $image = $_SESSION['profile_image'];
    } else {
        header("Location: ../login/login.php");
        exit(); 
    }
    ?>

        <div class="header">
            <div class="logo">
                <img src="../photoes/admin.png" />
                <span class="nav-item">Welcome <?php echo $userType; ?> <br> <?php echo $userName; ?></span>
            </div>


            <div class="greeting">
                <div id="greeting-message"></div>
                <div id="username">
                    <p>UserID: <?php echo $row['fake_user'];?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <nav>
                <ul>
                    <li>
                        <a href="../admin_dashboard/totalusers.php">
                            <i class="fas fa-sharp fa-solid fa-gauge"></i>
                            <span class="nav-item">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../admin_dashboard/complaint_det.php">
                            <i class="fas fa-comment"></i>
                            <span class="nav-item">Complaints</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="../admin_dashboard/product_report">
                            <i class="fas fa-database"></i>
                            <span class="nav-item">Product Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="../admin_dashboard/adduser.php" id="product_report">
                            <i class="fas fa-solid fa-user-pen"></i>
                            <span class="nav-item">Add User</span>
                        </a>
                    </li>
                    <li>
                        <a href="../admin_dashboard/add_product.php" id="product-link">
                            <i class="fas fa-chart-bar"></i>
                            <span class="nav-item">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="../crude/userdetails.php" id="user_details">
                            <i class="fas fa-cog"></i>
                            <span class="nav-item">User Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="../login/logout.php" class="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-item">Log out</span>
                        </a>
                    </li>
                </ul>
            </nav>
    </body>

</html>