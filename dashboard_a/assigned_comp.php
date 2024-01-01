<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../dashboard_a/style.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Complaints</title>
    <style>
    .containers {
        margin-top: 60px;
    }

    select {
        width: 100px;
        height: 25px;
        border: 1px solid black;
        border-radius: 5px;
    }

    .form-content {
        height: 100%;
    }

    .button_Status {
        border-radius: 0;
        width: 100px;
        color: white;
        border: none;
        cursor: pointer;
    }

    /* popup */
    .main {
        padding: 0px;
    }

    @media only screen and (max-width: 1200px) {
        * {
            flex-wrap: wrap;
        }
    }

    @media only screen and (max-width: 768px) {
        * {
            flex-wrap: wrap;
        }
    }


    input,
    select,
    textarea {
        border: 0.80px solid silver;
    }

    .photo input {
        border: none;
    }

    .popup {
        display: none;
        position: fixed;
        top: 45%;
        /* Center vertically */
        left: 50%;
        /* Center horizontally */
        transform: translate(-40%, -40%);
        /* Center both vertically and horizontally */
        width: 900px;
        max-height: 60%;
        /* Adjust as needed */

        /* Add scrollbar if content exceeds height */

    }

    .popup-content {
        background-color: white;
        padding: 0px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    #closePopup {
        position: relative;
        background-color: #4CAF50;
        border: none;
        font-size: 18px;
        color: #FFFFFF;
        padding: 1px;
        width: 80px;
        text-align: center;
        transition-duration: 0.4s;
        text-decoration: none;
        overflow: hidden;
        cursor: pointer;
        margin-top: 10px;
    }

    #closePopup:after {
        content: "";
        background: #f1f1f1;
        display: block;
        position: absolute;
        padding-top: 300%;
        padding-left: 350%;
        margin-left: -20px !important;
        margin-top: -120%;
        opacity: 0;
        transition: all 0.8s;
    }

    #closePopup:active:after {
        padding: 0;
        margin: 0;
        opacity: 1;
        transition: 0s;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .breadcrumb {
        display: flex;
        flex-wrap: wrap;
        padding: 0.75rem 1rem;
        list-style: none;
        background-color: #e9ecef;

    }
    </style>
</head>

<body>
    <?php include_once("../dashboard_a/admin_dash.php"); ?>
    <div class="main-content">
        <div class="containers">
            <div class="product-details">
                <div class="product-adding-form">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><b>Assigned Complaints</b></li>
                    </ol>
                </div>
            </div>
            <?php
       include_once('../connection/connection.php');
       $assignQuery = "SELECT c.id, c.category, c.type, c.department, c.nature, c.image, c.complain_description, c.complaint_datetime, c.complain_user, c.complaint_ticket, c.status, c.discharge_datetime, r.fake_user AS assigned_teacher_name
                      FROM complain AS c
                      JOIN complaint_assignment AS ca ON c.id = ca.complain_id
                      JOIN register AS r ON ca.teacher_id = r.id
                      WHERE c.status IN ('pending', 'in_progress')";
       
       $assignExe = mysqli_query($con, $assignQuery);
       
                ?>


            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">S.N.</th>
                        <th style="text-align: center;">User</th>
                        <th style="text-align: center;">Complaint Date/Time</th>
                        <th style="text-align: center;">Category</th>
                        <th style="text-align: center;">Ticket Number</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Assigned To</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <?php
    $serialNumber = 1;
    while ($row = mysqli_fetch_assoc($assignExe)) {
        ?>
                <tr class="view_com">
                    <td style="text-align: center; color:black; width:50px;"><?php echo $serialNumber; ?></td>
                    <td style="text-align: center; width:100px;"><?php echo $row['complain_user'] ?></td>
                    <td style=" text-align: center; width:200px;">
                        <?php echo date('Y-m-d h:i A', strtotime($row['complaint_datetime'])) ?></td>
                    <td style="text-align: center; width:140px;"><?php echo $row['category'] ?></td>
                    <td style="text-align: center; width:140px;"><?php echo $row['complaint_ticket'] ?></td>
                    <td style="width:140px;">
                        <select class="status-dropdown" data-complain-id="<?php echo $row['id']; ?>">
                            <option value="pending" <?php if ($row['status'] === 'pending') echo 'selected'; ?>>Pending
                            </option>
                            <option value="in_progress" <?php if ($row['status'] === 'in_progress') echo 'selected'; ?>>
                                In Progress</option>
                            <option value="resolved" <?php if ($row['status'] === 'resolved') echo 'selected'; ?>>
                                Resolved</option>
                            <option value="discharge" <?php if ($row['status'] === 'discharge') echo 'selected'; ?>>
                                Discharge</option>
                        </select>
                    </td>
                    
                    <td style="text-align: center; width:160px;">
                        <?php
                        if ($row['assigned_teacher_name'] !== null) {
                            echo 'Teacher: ' . $row['assigned_teacher_name'];
                        } else {
                            echo 'Admin';
                        }
                        ?>
                    </td>

                    <td style="text-align: center;">
                        <button onclick="openPopup('<?php echo $row['complaint_ticket']; ?>')">
                            <i class="las la-eye"></i> View
                        </button>
                    </td>
                </tr>
                <?php
        $serialNumber++; // Increment the serial number for the next row
    }
    ?>
            </table>


            <!-- End Solved Complaint List ... -->
        </div>
        <?php
        if (mysqli_num_rows($assignExe) > 0) {
            ?>
        <table class="table">
            <!-- Your table code for processing complaints here -->
        </table>
        <?php
        } else {
            // Display the message when there are no processing complaints
            ?>
        <div class="product-details">
            <div class="product-adding-form">
                <div style="padding: 30px; background-color: rgb(125, 124, 124); color:rgb(241, 239, 239);">
                    <li class="breadcrumb-item active"><b>There is no any Assigned Complaints</b></li>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <!-- ..............................................................POPUP START................................................................... -->
    <!-- ?php include_once("../student_dashboard/student_dash.php"); ?> -->
    <div class="container-fluid">
        <div id="popup" class="popup">
            <div class="popup-content" id="popup-content">
                <!-- Content inside the popup will be loaded here dynamically -->

                <!-- Close button -->
                echo '<button id="closePopupPopupContent">Close</button>';

            </div>
        </div>
    </div>

    <!-- ... (your existing code) ... -->

    <script>
    // Function to open the popup with the specified complaint ID
    function openPopup(complaintID) {
        // Use AJAX to fetch complaint details based on the complaint ID
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Request was successful, display complaint details in the popup
                    var popupContent = document.getElementById('popup-content');
                    popupContent.innerHTML = xhr.responseText;

                    var popup = document.getElementById('popup');
                    popup.style.display = 'block'; // Display the popup
                } else {
                    console.error('Failed to fetch complaint details: Status ' + xhr.status);
                }
            }
        };
        xhr.open('GET', 'fetch_complaint_details.php?complaintID=' + complaintID, true);
        xhr.send();
    }

    // Function to close the popup
    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    // Attach the click event listener to the close button
    document.getElementById('closePopupPopupContent').addEventListener('click', function() {
        console.log('Close button clicked'); // Debug statement
        closePopup();
    });
    </script>


    <!-- ........................................Popup Section End..................................... -->



    <!-- Don't touch code............................................*****.................................. -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusDropdowns = document.querySelectorAll('.status-dropdown');

        statusDropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                const complainId = this.getAttribute('data-complain-id');
                const newStatus = this.value;
                updateStatus(complainId, newStatus);
            });
        });
    });

    function updateStatus(complainId, newStatus) {
        // Make an AJAX request to update the status in the database
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Refresh the page after successful status update
                location.reload();
            }
        };
        xhr.open("POST", "update_status.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("complain_id=" + complainId + "&new_status=" + newStatus);
    }

    function deleteComplaint(complainId) {
        if (confirm("Are you sure you want to delete this complaint?")) {
            fetch('delete_assigned.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'complain_id=' + complainId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'Success') {
                        // Reload the page after successful deletion
                        location.reload();
                    } else {
                        console.error('Error: Failed to delete the complaint.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
    </script>
</body>

</html>