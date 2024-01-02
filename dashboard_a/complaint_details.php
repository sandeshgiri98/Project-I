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
                        <li class="breadcrumb-item active"><b>Pending Complaints</b></li>
                    </ol>
                </div>
            </div>
            <?php
                include_once('../connection/connection.php');
                $pendingQuery = "SELECT id, category, type, department, nature, image, complain_description, complaint_datetime, complain_user, complaint_ticket, status, discharge_datetime FROM complain WHERE status = 'pending' AND id NOT IN (SELECT complain_id FROM complaint_assignment)";
                $pendingExe = mysqli_query($con, $pendingQuery);

                
                ?>

            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">S.N.</th>
                        <th style="text-align: center;">User</th>
                        <th style="text-align: center;">Complaint Date/Time</th>
                        <th style="text-align: center;">Nature</th>
                        <th style="text-align: center;">Ticket Number</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Action</th>
                        <th style="text-align: center;">Assign To</th>
                    </tr>
                </thead>
                <?php
                $serialNumber = 1;
                while ($row = mysqli_fetch_assoc($pendingExe)) {
                    ?>
                <tr class="view_com">
                    <td style="text-align: center; color:black; width:36px;"><?php echo $serialNumber; ?></td>
                    <td style="text-align: center; width:95px;"><?php echo $row['complain_user'] ?></td>
                    <td style=" text-align: center; width:180px;">
                        <?php echo date('Y-m-d h:i A', strtotime($row['complaint_datetime'])) ?></td>
                    <td style="text-align: center; width:160px;"><?php echo $row['nature'] ?></td>
                    <td style="text-align: center; width:105px;"><?php echo $row['complaint_ticket'] ?></td>
                    <td style="text-align: center; width: 86px;">
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

                    <td style="text-align:center;">
                        <button onclick="openPopup('<?php echo $row['complaint_ticket']; ?>')">
                            <i class="las la-eye"></i> View
                        </button>
                        <button onclick="deleteComplaint(<?php echo $row['id']; ?>)"
                            style="background-color: transparent; border: 1px solid red;"
                            onmouseover="this.style.backgroundColor='red';"
                            onmouseout="this.style.backgroundColor='transparent';">
                            <i class="las la-trash"></i>
                            Delete
                        </button>
                    </td>
                 <!-- ................................................................Assign Garni................................................. -->

                 <td style="text-align: center;">
                        <select class="assign-to-dropdown">
                            <option>Select</option>
                            <?php
                            // Retrieve a list of teachers from the "register" table
                            $teacherQuery = "SELECT id, fake_user FROM register WHERE role = 'teacher'";
                            $teacherExe = mysqli_query($con, $teacherQuery);

                            while ($teacherRow = mysqli_fetch_assoc($teacherExe)) {
                                echo '<option value="' . $teacherRow['id'] . '">' . $teacherRow['fake_user'] . '</option>';
                            }
                            ?>
                        </select>
                        <button onclick="assignComplaint(this, <?php echo $row['id']; ?>)">
                            Assign
                        </button>
                    </td>



                </tr>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                function assignComplaint(button, complaintId) {
                    // Debugging: Log a message to the console to confirm the function is called
                    console.log('assignComplaint called');

                    // Get the selected teacher ID
                    var teacherId = $(button).siblings('.assign-to-dropdown').val();

                    // Debugging: Log the selected teacher ID
                    console.log('Selected Teacher ID:', teacherId);

                    // Make an AJAX request to assign the complaint
                    $.ajax({
                        type: 'POST',
                        url: 'assign_complaint.php', // Create this PHP file to handle the assignment
                        data: {
                            complaintId: complaintId,
                            teacherId: teacherId
                        },
                        success: function(response) {
                            // Debugging: Log the response from the server
                            console.log('Server Response:', response);

                            // Handle the response, e.g., remove the row from the table
                            if (response === 'success') {
                                // Debugging: Log a message to confirm the row removal
                                console.log('Row removed');
                                $(button).closest('tr').remove();
                            } else {
                                alert('Assignment failed. Please try again.');
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            // Debugging: Log any AJAX request errors to the console
                            console.error('AJAX Error:', textStatus, errorThrown);
                        }
                    });
                }
                </script>


                <!-- .....................................................................Assign huna garo vayo.................................................. -->
                <?php
                    $serialNumber++; // Increment the serial number for the next row
                }
                ?>
            </table>

            <?php
                if (mysqli_num_rows($pendingExe) > 0) {
                    // Display your content here
                } else {
                    ?>
            <div class="product-details">
                <div class="product-adding-form">
                    <div style="padding: 30px; background-color: rgb(125, 124, 124); color:rgb(241, 239, 239);">
                        <li class="breadcrumb-item active"><b>There is no any Pending Complaints</b></li>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            <!-- .....................................This code is for Processing Complaint............................................................................ -->

            <!-- Solved Complaint List ... -->
            <div class="product-details">
                <div class="product-adding-form">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><b>Processing Complaints</b></li>
                    </ol>
                </div>
            </div>
            <?php
                include_once('../connection/connection.php');

                // Fetch processing complaints excluding those with status "Pending" or "In Progress"
                $processQuery = "SELECT id, category, type, department, nature, image, complain_description, complaint_datetime,complaint_ticket, complain_user, status, resolved_datetime FROM complain WHERE status = 'in_progress' AND id NOT IN (SELECT complain_id FROM complaint_assignment WHERE status IN ('pending', 'in_progress'))";
                $processExe = mysqli_query($con, $processQuery);
                ?>

            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">S.N.</th>
                        <th style="text-align: center;">User</th>
                        <th style="text-align: center;">Complaint Date/Time</th>
                        <th style="text-align: center;">Category</th>
                        <th style="text-align: center;">Nature</th>
                        <th style="text-align: center;">Ticket Number</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <?php
                $serialNumber = 1;
                while ($row = mysqli_fetch_assoc($processExe)) {
                    ?>
                <tr class="view_com">
                    <td style="text-align: center; color:black; width:50px;"><?php echo $serialNumber; ?></td>
                    <td style="text-align: center; width:100px;"><?php echo $row['complain_user'] ?></td>
                    <td style=" text-align: center; width:200px;">
                        <?php echo date('Y-m-d h:i A', strtotime($row['complaint_datetime'])) ?></td>
                    <td style="text-align: center; width:140px;"><?php echo $row['category'] ?></td>
                    <td style="text-align: center; width:200px;"><?php echo $row['nature'] ?></td>
                    <td style="text-align: center; width:120px;"><?php echo $row['complaint_ticket'] ?></td>
                    <td style="width:90px;">
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
                    <td style="text-align: center;">
                        <button onclick="openPopup('<?php echo $row['complaint_ticket']; ?>')">
                            <i class="las la-eye"></i> View
                        </button>
                        <button onclick="deleteComplaint(<?php echo $row['id']; ?>)"
                            style="background-color: transparent; border: 1px solid red;"
                            onmouseover="this.style.backgroundColor='red';"
                            onmouseout="this.style.backgroundColor='transparent';">
                            <i class="las la-trash"></i>
                            Delete
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
        if (mysqli_num_rows($processExe) > 0) {
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
                    <li class="breadcrumb-item active"><b>There is no any Processing Complaints</b></li>
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

    <!-- 
    <style>
    .transparent-button {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 10px;
        /* Adjust the padding to increase the button size */
    }

    .transparent-button i {
        font-size: 24px;
        /* Adjust the icon size as needed */
    }

    .transparent-button:hover {
        color: red;
    }
    </style>
    <div class="popup-container" id="popup">
        <div class="popup-box">
            <div class="popup-close">
                <button onclick="closePopup()">Close</button>
            </div>
            <div id="popup-content">
           
            </div>
        </div>
    </div>


    <script>
    function openPopup(complainId) {
        const popup = document.getElementById('popup');
        const popupContent = document.getElementById('popup-content');

        // Fetch complaint details from the server using PHP
        fetch('fetch_complaint.php?complain_id=' + complainId)
            .then(response => response.json())
            .then(data => {
                const hasImage = data.image !== null && data.image !== ''; // Check if there is an image

                // Create the content based on the presence of an image and fetched data
                let content = `
                        <h2>Complaint Details</h2>
                        <p><strong>User:</strong> ${data.complain_user}</p>
                        <p><strong>Date:</strong> ${data.complaint_datetime}</p>
                        <p><strong>Description:</strong> ${data.complain_description}</p>
                        <p><strong>Category:</strong> ${data.category}</p>
                        <p><strong>Type:</strong> ${data.type}</p>
                        <p><strong>Department:</strong> ${data.department}</p>
                        <p><strong>Nature:</strong> ${data.nature}</p>
                        <p><strong>Status:</strong> ${data.status}</p>
                    `;

                if (hasImage) {
                    // If there is an image, add it to the content
                    content += `
                            <img src="${data.image}" alt="Complaint Image" class="popup-image">
                        `;
                }

                // Set the popup content
                popupContent.innerHTML = content;

                // Display the popup
                popup.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function closePopup() {
        const popup = document.getElementById('popup');
        popup.style.display = 'none';
    }
    </script> -->





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
            fetch('delete_complaint.php', {
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