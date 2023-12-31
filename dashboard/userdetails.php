<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../dashboard/style.css">
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

.center-header {
        text-align: center;
    }
    
</style>
</body>

</html>

<body>
    <?php
    include_once('../dashboard/admin_dash.php');
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

    $selectQuery = "SELECT id, name, email, phone, dob, password, role, registration_datetime, last_login_time, fake_user FROM register";
    $selectExe = mysqli_query($con, $selectQuery);
    ?>
   <div class="main-content">
    <section class="main">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="center-header">S.N.</th>
                        <th class="center-header">Name</th>
                        <th class="center-header">Email</th>
                        <th class="center-header">Password</th>
                        <th class="center-header">Phone</th>
                        <th class="center-header">Date of Birth</th>
                        <th class="center-header">Role</th>
                        <th class="center-header">Registration Date</th>
                        <th class="center-header">User ID</th>
                        <th class="center-header">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serialNumber = 1; // Initialize the serial number
                    while ($row = mysqli_fetch_assoc($selectExe)) {
                        $userId = $row['id'];
                        $rowRole = $row['role'];

                        // Exclude rows with roles "admin" and "super admin" and rows that belong to the current user
                        if ($rowRole !== "admin" && $rowRole !== "Super Admin" && $userId !== $currentUserId) {
                            ?>
                            <tr>
                                <td style="color:black"><?php echo $serialNumber++; ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['dob'] ?></td>
                                <td><?php echo $row['role'] ?></td>
                                <td><?php echo $row['registration_datetime'] ?></td>
                                <td><?php echo $row['fake_user'] ?></td>
                                <td class="crude" style="display: flex; gap:10px;">
                                    <button onclick="window.location.href='../crude/update.php?id=<?php echo $row['id'] ?>'">Update</button>
                                    <?php
                                    $deleteDisabled = $userId === $currentUserId ? 'disabled' : '';
                                    ?>
                                    <button class="delete-btn" data-id="<?php echo $userId; ?>" style="color: red" <?php echo $deleteDisabled; ?> onclick="deleteConfirmation(<?php echo $userId; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>





    <div class="popup" id="popup">
        <img src="../pop_up/delete.png">
        <h2 style="color:red">Delete</h2>
        <p>Are you sure you want to delete?</p>
        <div class="configure">
            <button type="btn" onclick="deleteUser()">Yes</button>
            <button type="btn" onclick="closePopup()">No</button>
        </div>
    </div>
    <div class="overlay"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function deleteConfirmation(userId) {
        if (userId === <?php echo $currentUserId; ?>) {
            alert('Error! You are not allowed to delete your own user ID.');
            return;
        }

        openPopup();
        showOverlay();

        document.querySelector('#popup .configure button:first-child').onclick = function() {
            closePopup();
            deleteUser(userId);
        };
        document.querySelector('#popup .configure button:last-child').onclick = function() {
            closePopup();
        };
    }

    function openPopup() {
        let popup = document.getElementById("popup");
        popup.classList.add("open-popup");
    }

    function closePopup() {
        let popup = document.getElementById("popup");
        popup.classList.remove("open-popup");
        hideOverlay();
    }

    function showOverlay() {
        let overlay = document.querySelector(".overlay");
        overlay.style.display = "block";
    }

    function hideOverlay() {
        let overlay = document.querySelector(".overlay");
        overlay.style.display = "none";
    }

    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var userId = $(this).data('id');
            deleteConfirmation(userId);
        });
    });

    function deleteUser(userId) {
        $.ajax({
            url: '../crude/ajax_delete.php',
            method: 'POST',
            data: {
                id: userId
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    console.log(data.message);
                    location.reload();
                } else {
                    console.error(data.message);
                    alert(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting user: ' + error);
                alert('Error deleting user. Please try again later.');
            }
        });
    }
    </script>


</body>

</html>