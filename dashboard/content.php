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
   include_once('../dashboard/admin_dash.php')
   ?>


    <div class="main-content">

        <main>

            <div class="page-header">
                <h1>Dashboard</h1>
            </div>

            <div class="page-content">

                <div class="analytics">

                    <?php
                    include_once('../connection/connection.php');

                    // Count new complaints from the database
                    $newSql = "SELECT COUNT(*) AS total_new FROM complain WHERE status = 'pending'";
                    $newResult = mysqli_query($con, $newSql);

                    if ($newResult) {
                        $newRow = mysqli_fetch_assoc($newResult);
                        $totalNew = $newRow["total_new"];
                    } else {
                        $totalNew = 0;
                    }

                    // Count the number of assigned complaints that are pending
                    $assignedPendingSql = "SELECT COUNT(*) AS total_assigned_pending FROM complaint_assignment AS ca
                                            JOIN complain_details AS cd ON ca.complain_id = cd.complaint_id
                                            WHERE cd.status = 'pending'";
                    $assignedPendingResult = mysqli_query($con, $assignedPendingSql);

                    if ($assignedPendingResult) {
                        $assignedPendingRow = mysqli_fetch_assoc($assignedPendingResult);
                        $totalAssignedPending = $assignedPendingRow["total_assigned_pending"];
                    } else {
                        $totalAssignedPending = 0;
                    }

                    // Calculate the total number of pending complaints excluding assigned ones
                    $totalPending = $totalNew - $totalAssignedPending;
                    ?>

                    <div class="card">
                        <a href="../dashboard/complaint_details.php">
                            <div class="card-head">
                                <h2><?php echo $totalPending; ?></h2>
                                <span class="las la-envelope"></span>
                            </div>
                            <div class="card-progress">
                                <small>New Complaints</small>
                                <div class="card-indicator">
                                    <div class="indicator four" style="width: 100%"></div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <?php
                    include_once('../connection/connection.php');

                    // Count processing complaints from the database
                    $processingSql = "SELECT COUNT(*) AS total_processing FROM complain WHERE status = 'in_progress'";
                    $processingResult = mysqli_query($con, $processingSql);

                    if ($processingResult) {
                        $processingRow = mysqli_fetch_assoc($processingResult);
                        $totalProcessing = $processingRow["total_processing"];
                    } else {
                        $totalProcessing = 0;
                    }

                    // Count the number of assigned complaints that are in progress
                    $assignedInProgressSql = "SELECT COUNT(*) AS total_assigned_in_progress FROM complaint_assignment AS ca
                                                JOIN complain_details AS cd ON ca.complain_id = cd.complaint_id
                                                WHERE cd.status = 'in_progress'";
                    $assignedInProgressResult = mysqli_query($con, $assignedInProgressSql);

                    if ($assignedInProgressResult) {
                        $assignedInProgressRow = mysqli_fetch_assoc($assignedInProgressResult);
                        $totalAssignedInProgress = $assignedInProgressRow["total_assigned_in_progress"];
                    } else {
                        $totalAssignedInProgress = 0;
                    }

                    // Calculate the total number of processing complaints excluding assigned ones
                    $totalProcessingExcludingAssigned = $totalProcessing - $totalAssignedInProgress;
                    ?>

                    <div class="card">
                        <a href="../dashboard/complaint_details.php">
                            <div class="card-head">
                                <h2><?php echo $totalProcessingExcludingAssigned; ?></h2>
                                <span class="las la-eye"></span>
                            </div>
                            <div class="card-progress">
                                <small>Processing Complaints</small>
                                <div class="card-indicator">
                                    <div class="indicator two" style="width: 100%"></div>
                                </div>
                            </div>
                        </a>
                    </div>



                    <div class="card">
                        <a class="redirect_profile" href="../dashboard/solved_comp.php">
                            <div class="card-head">
                                <?php
                            // Count resolved complaints from the database
                            $resolvedSql = "SELECT COUNT(*) AS total_resolved FROM complain WHERE status = 'resolved'";
                            $resolvedResult = mysqli_query($con, $resolvedSql);
                            
                            if ($resolvedResult) {
                                $resolvedRow = mysqli_fetch_assoc($resolvedResult);
                                $totalResolved = $resolvedRow["total_resolved"];
                            } else {
                                $totalResolved = 0;
                            }
                        ?>
                                <h2><?php echo $totalResolved; ?></h2>

                                <span class="las la-thumbs-up"></span>
                            </div>
                            <div class="card-progress">
                                <small>Solved Complaints</small>
                                <div class="card-indicator">
                                    <div class="indicator three" style="width: 100%"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="card">
                        <a class="redirect_profile" href="../dashboard/assigned_comp.php">
                            <div class="card-head">
                                <div class="main">
                                    <?php
                include_once('../connection/connection.php');

                // Modify the SQL query to count assigned complaints that are pending
                $sql = "SELECT COUNT(*) AS total_assigned_complaints FROM complaint_assignment AS ca
        JOIN complain_details AS cd ON ca.complain_id = cd.complaint_id
        WHERE cd.status IN ('pending', 'in_progress')";


                $result = mysqli_query($con, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalAssignedComplaints = $row["total_assigned_complaints"];
                } else {
                    $totalAssignedComplaints = 0;
                }
                ?>
                                    <h2><?php echo $totalAssignedComplaints; ?></h2>
                                </div>
                                <span class="las la-user-friends"></span>
                            </div>
                            <div class="card-progress">
                                <small>Assigned Complaints</small>
                                <div class="card-indicator">
                                    <!-- You can style the indicator here based on your requirements -->
                                    <div class="indicator"
                                        style="background:#0071ff; width: <?php echo ($totalAssignedComplaints > 0) ? '100%' : '0%'; ?>">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



            <style>
            .print button {
                background: var(--main-color);
                color: #fff;
                height: 37px;
                border-radius: 4px;
                padding: 0rem 1rem;
                border: none;
                font-weight: 600;
                transition: padding 0.3s ease, box-shadow 0.3s ease;
                /* Add transitions for smooth effects */
            }

            .print button:hover {
                padding: 0rem 2rem;
                cursor: pointer;
            }

            /* Add shadow when the button is clicked (active state) */
            .print button:active {
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            }

            #exportButton {

                border: none;
                border-radius: 5px;
                /* Rounded corners */

                cursor: pointer;
                display: flex;
                align-items: center;
            }

            #exportButton i {

                /* Adjust the icon size as needed */
                margin-right: 5px;
                /* Add spacing between the icon and text */
            }

            .redirect_profile {
                cursor: pointer;
            }
            </style>

            <div class="records table-responsive">
                <div class="record-header">
                    <div class="print">
                        <div class="print">
                            <button id="exportButton">
                                <i class="las la-download"></i> Export Records
                            </button>
                        </div>

                    </div>
                    <div class="records table-responsive">

                    </div>

                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Get a reference to the export button
                        var exportButton = document.getElementById("exportButton");

                        // Add a click event listener to the export button
                        exportButton.addEventListener("click", function() {
                            // Redirect to the print.php page
                            window.location.href = "../print/print.php";
                        });
                    });
                    </script>


                    <div class="browse">
                        <input type="search" placeholder="Search" class="record-search">
                        <!-- <select name="" id="">
                                <option value="">Status</option>
                            </select> -->
                    </div>
                </div>


                <div>
                    <div>
                        <?php
    include_once('../connection/connection.php');

    $selectQuery = "SELECT user_id, name, email, phone, dob, role, registration_datetime, last_login_time, profile_image,
                    complaint_id, category, complain_user, type, department, nature, image, complain_description, complaint_datetime, status FROM complain_details WHERE status = 'pending'";
    $selectExe = mysqli_query($con, $selectQuery);
    ?>

                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>USER-ID</th>
                                    <th><span class="las la-sort"></span> USERS</th>
                                    <th><span class="las la-sort"></span> COMPLAINT DATE</th>
                                    <th><span class="las la-sort"></span> ROLE</th>
                                    <th><span class="las la-sort"></span> Nature</th>
                                    <th><span class="las la-sort"></span> Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($selectExe)) {
                $profileImageName = $row['profile_image'];
                $profileImageURL = '../photoes/' . $profileImageName;
                ?>
                                <tr>
                                    <td><?php echo $row['complain_user']; ?></td>
                                    <td>
                                        <a class="redirect_profile" href="../dashboard/complaint_details.php">
                                            <div class="client">
                                                <?php
                                // Check if the database profile_image is valid and exists
                                if (!empty($profileImageName) && file_exists($profileImageURL)) {
                                    echo '<div class="client-img bg-img" style="background-image: url(\'' . $profileImageURL . '\')"></div>';
                                } else {
                                    // If the database profile_image is empty or does not exist, display the default profile picture
                                    echo '<div class="client-img bg-img" style="background-image: url(\'../photoes/admin.png\')"></div>';
                                }
                                ?>

                                                <div class="client-info">
                                                    <h4><?php echo $row['name']; ?></h4>
                                                    <small><?php echo $row['email']; ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td><?php echo $row['complaint_datetime']; ?></td>
                                    <td><span style="text-transform: uppercase;"><?php echo $row['role']; ?></span></td>
                                    <td><?php echo $row['nature']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div id="profile-container"></div>

        </main>

    </div>
</body>

</html>