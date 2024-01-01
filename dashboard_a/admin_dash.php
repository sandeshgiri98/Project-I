<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <?php
    include_once('../connection/connection.php');

    // Start the session (if not already started)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get the 'fake_user' value from the database based on the 'user_id'
    $userId = $_SESSION['user_id']; 
    $selectQuery = "SELECT fake_user FROM register WHERE id = '$userId'"; 
    $selectExe = mysqli_query($con, $selectQuery);
    $row = mysqli_fetch_assoc($selectExe);
    $_SESSION['fake_user'] = $row['fake_user'];

    // Check if the 'user_name' session variable is set
    if (isset($_SESSION['user_name'])) {
        $userName = $_SESSION['user_name'];
        $userType = $_SESSION['role']; // Assuming the role is stored in 'role' session variable
        $fakeUser = $_SESSION['fake_user'];
        // $image = $_SESSION['profile_image'];
    } else {
        header("Location: ../login/login.php");
        exit(); 
    }
    ?>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <p><span>User-ID: <?php echo $row['fake_user']; ?></span></p>
        </div>

        <div class="side-content">
            <div class="profile">
                <?php
    if (isset($_SESSION['fake_user'])) {
        $fakeUserID = $_SESSION['fake_user'];

        $selectQuery = "SELECT id, name, fake_user, profile_image FROM register WHERE fake_user = '$fakeUserID'";
        $selectExe = mysqli_query($con, $selectQuery);

        if (mysqli_num_rows($selectExe) > 0) {
            $row = mysqli_fetch_assoc($selectExe);
            $img = $row['profile_image'];
            $userName = $row['name'];

            // Check if the profile image exists, else use default image
            if ($img && file_exists('../photoes/' . $img)) {
                $profileImageURL = '../photoes/' . $img;
            } else {
                $profileImageURL = '../photoes/user.png'; // Replace 'user.jpg' with your default image filename and path
            }
        } else {
            echo "No user found with the specified fake_user ID.";
        }
    } else {
        echo "Session 'fake_user' variable not set or session not started.";
    }
    ?>

                <div class="profile-img bg-img" style="background-image: url('<?php echo $profileImageURL; ?>');"></div>

                <h4><?php echo $userName; ?></h4>
                <small style="text-transform: uppercase"><?php echo $userType; ?></small>
            </div>


            <div class="side-menu">
                <ul>
                    <li>
                        <a href="../dashboard_a/content.php">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                        <a href="../profile_a/profile_setting.php">
                            <span class="las la-user-alt"></span>
                            <small>Profile</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/complaint_details.php">
                            <span class="las la-envelope"></span>
                            <small>Complaint Details</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/solved_comp.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Solved/Discharged Complaints</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/assigned_comp.php">
                        <span class="las la-share-square"></span>
                            <small>Assigned Complaints</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/adduser.php">
                        <span class="las la-user-plus"></span>
                            <small>Add User</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/userdetails.php">
                            <span class="las la-tasks"></span>
                            <small>User Details</small>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboard_a/feedback.php">
                            <span class="las la-envelope-open-text"></span>
                            <small>Feedbacks</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">

        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <!-- <label for="">
                        <span class="las la-search"></span>
                    </label>

                    <div class="notify-icon">
                        <span class="las la-envelope"></span>
                        <span class="notify">4</span>
                    </div>

                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">3</span>
                    </div> -->

                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>

                        <a href="../login/logout.php" style="text-decoration: none;">
                            <span class="las la-power-off"></span>
                            <span style="font-size:16px">Logout</span></a>

                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- link -->
    <script>
    const menuLinks = document.querySelectorAll('.side-menu a');
    const currentBaseURL = window.location.href.split('?')[0];
    menuLinks.forEach(link => {
        if (link.href === currentBaseURL) {
            link.classList.add('active');
        }
        link.addEventListener('click', function(event) {
            menuLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });
    </script>



</body>

</html>