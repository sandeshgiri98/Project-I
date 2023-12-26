<!DOCTYPE html>
<html>
<head>
    <title>User Action</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../admin_dashboard/dashboard.css">
</head>
<body>
<?php
include_once('../admin_dashboard/dashboard.php');
include_once('../admin_dashboard/connection.php');

$selectQuery = "SELECT id, name, email, phone, dob, password, role, registration_datetime, last_login_time, fake_user FROM register";
$selectExe = mysqli_query($con, $selectQuery);
?>

<section class="main">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Registration Date</th>
                    <th>User ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($selectExe)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['dob'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td><?php echo $row['registration_datetime'] ?></td>
                        <td><?php echo $row['fake_user'] ?></td>
                        <td class="crude" style="display: flex; gap:10px;">
                            <button onclick="window.location.href='../crude/update.php?id=<?php echo $row['id'] ?>'">Update</button>
                            <button class="delete-btn" style="color: red; border-color: none;" data-id="<?php echo $row['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            console.log('ID:', id);

            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    url: 'ajax_delete.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json', // Added data type for response
                    success: function(response) {
                        console.log(response);

                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Error deleting record: ' + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ajax request error: ' + error);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
