<?php
include_once('../connection/connection.php');

// Get the complaint ID from the query string
$complaintID = $_GET['complaintID'];

// Query to fetch complaint details
$selectQuery = "SELECT * FROM complain WHERE complaint_ticket = '$complaintID'";
$selectExe = mysqli_query($con, $selectQuery);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
    /* Add this CSS to style the container */
    .container {
        margin-top: 0px;
        padding: 20px;
        width: 100%;
        background-color: rgb(241, 239, 239);
        border: 1px solid black;
        max-height: 400px;
        /* Set a maximum height for the container */
        overflow: auto;
        /* Allow the inner content to scroll if it exceeds the container height */
    }


    .container p {
        text-align: left;
        margin: 0;
        padding-bottom: 10px;
    }

    .popup-button {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php
   

    if ($row = mysqli_fetch_assoc($selectExe)) {
        // Display complaint details with styling
        echo '<p style="color:red; font-size:18px; text-align:center;"><strong>Complaint Details</strong></p>';
        echo '<div style="border: 1px solid #ccc; width: 100%; padding: 10px; ">';

        echo '<p style="text-align: left;"><strong>Category:</strong> ' . $row['category'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
        // Display Type, Department, Nature, and Description in a similar manner
        echo '<p style="text-align: left;"><strong>Type:</strong> ' . $row['type'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';

        echo '<p style="text-align: left;"><strong>Department:</strong> ' . $row['department'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
        echo '<p style="text-align: left;"><strong>Nature:</strong> ' . $row['nature'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';

        echo '<p style="text-align: left;"><strong>Description:</strong> ' . $row['complain_description'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
        echo '<p style="text-align: left;"><strong>Complaint Date/Time:</strong> ' . $row['complaint_datetime'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
        echo '<p style="text-align: left;"><strong>Complain Status:</strong> <span style="color: red;">' . $row['status'] . '</span></p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
        echo '<p style="text-align: left;"><strong>Ticket Number:</strong> ' . $row['complaint_ticket'] . '</p>';
        echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
        
         // Check if there is an image
         if (!empty($row['image'])) {
            $imagePath = '../photoes/' . $row['image']; // Assuming '../photoes/' is the correct path prefix
            if (file_exists($imagePath)) {
                echo '<p style="text-align: left;"><strong>Image:</strong> ';
                echo '<a href="' . $imagePath . '" target="_blank" style="text-decoration: none; rgb(39, 158, 255)">'; // Added target="_blank" to open in a new tab
                echo '<strong>Click to view Image</strong>'; // Text to display
                echo '</a>';
                echo '</p>';
                echo '<p style="border-bottom: 1px solid #ccc; margin: 0 0 10px 0; padding-bottom: 10px;"></p>';
            } else {
                echo '<p style="text-align: left;"><strong>Image:</strong> Image not Attached</p>';
            }
        }
        
        // Check if the complaint is solved
        $status = $row['status'];

        if ($status === 'resolved' && !empty($row['resolved_datetime'])) {
            echo '<p style="text-align: left;"><strong>Solved Date/Time:</strong> ' . $row['resolved_datetime'] . '</p>';
        } elseif ($status === 'discharge' && !empty($row['discharge_datetime'])) {
            echo '<p style="text-align: left;"><strong>Discharged Date/Time:</strong> ' . $row['discharge_datetime'] . '</p>';
        } else {
            echo '<p><strong>Solved Date/Time:</strong> Not Solved Yet, It may take some time!!</p>';

        }

        
        echo '</div>';
        } else {
            echo 'Complaint not found';
        }
        echo '<div class="popup-button"><button id="closePopup" onclick="closePopup()" style="width: 90px;">Close</button></div>';


    ?>
    </div>
    <script>
    function closePopup() {
        document.querySelector('.popup').style.display = 'none';
    }
    </script>
</body>

</html>