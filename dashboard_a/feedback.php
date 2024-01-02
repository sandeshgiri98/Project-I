<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../dashboard_a/style.css">
    <link rel="stylesheet" href="../pop_up/style.css">
    <link rel="stylesheet" href="your_custom_css.css">
    <title>User Action</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
.main-container {
    background-color: white;
}

.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
}

.open-popup {
    z-index: 99999;
}

/* .center-header {
        text-align: center;
    } */
</style>
</body>

</html>

<body>
    <?php
    include_once('../dashboard_a/admin_dash.php');
    include_once('../connection/connection.php');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        $currentUserId = $_SESSION['user_id'];
    } else {
        header("Location: ../login/login.php");
        exit();
    }

    // Retrieve the role of the current user
    $selectRoleQuery = "SELECT role FROM register WHERE id = $currentUserId";
$selectRoleExe = mysqli_query($con, $selectRoleQuery);
$currentUserRole = mysqli_fetch_assoc($selectRoleExe)['role'];

$selectQuery = "SELECT userid, description FROM feedback";
$selectExe = mysqli_query($con, $selectQuery);
?>
<div class="main-content">
    <section class="main">
        <div class="container">
            <table class="table" >
                <thead>
                    <tr>
                        <th class="center-header" >UserId</th>
                        <th class="center-header">Feedback</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($selectExe)) {
                        $feedbackUserId = $row['userid'];
                        $feedbackDescription = $row['description'];

                        // Display feedback data
                        ?>
                        <tr>
                            <td><?php echo $feedbackUserId; ?></td>
                            <td><?php echo $feedbackDescription; ?></td>
                           
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>


</body>

</html>