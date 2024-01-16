<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="popup.css">
    <style>
    .sadmin_popup,
    .admin_popup,
    .teacher_popup,
    .student_popup {
        background: #fff;
        border-radius: 5px;
        max-width: 300px;
        text-align: center;
        margin: 70px auto;
        padding: 40px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div id="complaint-status-popup" class="student_popup" style="display: none;">
        <!-- <img src="../photoes/tick.gif" alt="Image Not found"> -->
        <h2>Your Complaint Status is</h2>
        <h2 id="complaint-status"><?php echo getStatusLabel($status); ?></h2>
    </div>

    <div id="complaint-error-popup" style="display: none;">
        <img src="../photoes/wrong.gif" class="invalid" alt="Image Not found">
        <h2 class="incorrect">Incorrect <br>Complaint Ticket</h2>
        <p>Please try again.</p>
    </div>

    <!-- PHP for checking and displaying complaint status -->
    <?php
    include("../connection/connection.php");

    $complaint_ticket = $_POST['complaint_ticket']; // Assuming the input field name is "complaint_ticket"

    // Sanitize user input to prevent SQL injection
    $complaint_ticket = mysqli_real_escape_string($con, $complaint_ticket);

    $query = "SELECT status FROM complain WHERE complaint_ticket='$complaint_ticket'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];

        // Display the popup with the complaint status
        echo "<script>
            document.getElementById('complaint-status-popup').style.display='block';
            document.getElementById('complaint-status').textContent='" . getStatusLabel($status) . "'
            setTimeout(function(){
                window.location.href='../main-frontpage/frontpage.php'; 
            }, 1000);
        </script>";
        exit();
    } else {
        // Incorrect complaint_ticket
        echo "<script>
            document.getElementById('complaint-error-popup').style.display='block';
            setTimeout(function(){
                window.location.href='../main-frontpage/frontpage.php';
            }, 1000);
        </script>";
        exit();
    }

    // Function to map status values to labels
    function getStatusLabel($status) {
        switch ($status) {
            case 'in_progress':
                return 'In Progress';
            case 'pending':
                return 'Pending';
            case 'resolved':
                return 'Solved';
            case 'discharge':
                return 'Discharged';
            default:
                return 'Unknown';
        }
    }
    ?>

</body>

</html>
