<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../student_dashboard/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../profile_student/form.css">
    <title>Complaints</title>
</head>
<style>
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
    top: 50%; /* Center vertically */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, -50%); /* Center both vertically and horizontally */
    width: 900px;
    max-height: 80%; /* Adjust as needed */
    overflow-y: auto; /* Add scrollbar if content exceeds height */
    background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
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
</style>

<body>
    <!-- ?php include_once("../student_dashboard/student_dash.php"); ?> -->
    <div class="container-fluid">
        <div id="products" class="section">
            <button onclick="openPopup()">Open Popup</button>
            <div id="popup" class="popup">
                <div class="popup-content">
                    <h4>Complaint Details</h4>
                    <?php
                        include_once('../connection/connection.php');
                        // Retrieve the complaint ticket number from the database
                        $selectQuery = "SELECT id, category, type, department, nature, image, complain_description, complaint_datetime, complain_user, status, complaint_ticket FROM complain";
                        $selectExe = mysqli_query($con, $selectQuery);
                        ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">S.N.</th>
                                <th style="text-align: center;">Date and Time</th>
                                <th style="text-align: center;">Timeliness</th>
                                <th style="text-align: center;">Category</th>
                                <th style="text-align: center;">Type</th>
                                <th style="text-align: center;">Ticket Number</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <?php
                            $serialNumber = 1; // Initialize the serial number
                            while ($row = mysqli_fetch_assoc($selectExe)) {
                                $statusColor = '';
                                if ($row['status'] === 'pending') {
                                    $statusColor = 'rgb(26, 93, 26)';
                                } elseif ($row['status'] === 'in_progress') {
                                    $statusColor = 'rgb(63, 46, 62)';
                                } elseif ($row['status'] === 'resolved') {
                                    $statusColor = 'rgb(254, 0, 0)';
                                } elseif ($row['status'] === 'discharge') {
                                    $statusColor = 'rgb(117, 194, 246)';
                                } else {
                                    $statusColor = 'gray';
                                }
                            ?>
                        <tr>
                            <td style="text-align: center; color:black; width:50px;"><?php echo $serialNumber; ?></td>
                            <td style=" text-align: center; width:220px;">
                                <?php echo date('Y-m-d h:i A', strtotime($row['complaint_datetime'])) ?></td>
                            <td style="text-align: center; width:180px;"><span class="time-ago"
                                    data-datetime="<?php echo $row['complaint_datetime'] ?>"></span></td>
                            <td style="text-align: center; width:120px;"><?php echo $row['category'] ?></td>
                            <td style="text-align: center; width:120px;"><?php echo $row['type'] ?></td>
                            <td style="text-align: center; width:150px;"><?php echo $row['complaint_ticket'] ?></td>
                            <td style="text-align: center; width: 150px;"><button class="button_Status" type="button"
                                    style="background-color: <?php echo $statusColor; ?>; border: none;"><?php echo $row['status'] ?></button>
                            </td>
                        </tr>
                        <?php
                            $serialNumber++; // Increment the serial number for the next row
                        }
                        ?>
                    </table>
                    <button id="closePopup">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'block'; // Change to 'block' to center
        }
        document.getElementById('closePopup').addEventListener('click', function () {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        });
    </script>
    <script>
    // Function to calculate time ago
    function timeAgo(datetime) {
        const timestamp = new Date(datetime).getTime();
        const currentTime = new Date().getTime();
        const timeDiff = currentTime - timestamp;

        if (timeDiff < 60000) {
            return 'Just now';
        } else if (timeDiff < 3600000) {
            const minutes = Math.floor(timeDiff / 60000);
            return minutes === 1 ? minutes + ' minute ago' : minutes + ' minutes ago';
        } else if (timeDiff < 86400000) {
            const hours = Math.floor(timeDiff / 3600000);
            return hours === 1 ? hours + ' hour ago' : hours + ' hours ago';
        } else if (timeDiff < 604800000) {
            const days = Math.floor(timeDiff / 86400000);
            return days === 1 ? days + ' day ago' : days + ' days ago';
        } else if (timeDiff < 2419200000) {
            const weeks = Math.floor(timeDiff / 604800000);
            return weeks === 1 ? weeks + ' week ago' : weeks + ' weeks ago';
        } else {
            const months = Math.floor(timeDiff / 2419200000);
            return months === 1 ? months + ' month ago' : months + ' months ago';
        }
    }

    // Function to update time ago for each element with the class "time-ago"
    function updateTimeAgo() {
        const timeAgoElements = document.getElementsByClassName('time-ago');
        for (const element of timeAgoElements) {
            const datetime = element.getAttribute('data-datetime');
            element.textContent = timeAgo(datetime);
        }
    }

    // Function to fetch updated data using AJAX
    function fetchUpdatedData() {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Request was successful
                    const visibleContainer = document.getElementById('complaints-container');
                    visibleContainer.innerHTML = xhr.responseText;
                    updateTimeAgo();
                } else {
                    console.error('Failed to fetch data: Status ' + xhr.status);
                }
            }
        };
        xhr.onerror = function() {
            console.error('Failed to fetch data: Network error');
        };
        xhr.open('GET', 'fetch_data.php', true);
        xhr.send();
    }

    // Fetch updated data every 10 seconds (10000 milliseconds)
    setInterval(function() {
        fetchUpdatedData();
    }, 10000);

    // Initial update of time ago
    updateTimeAgo();
</script>
</body>

</html>

<!-- ........................................Popup Section Start...................................... -->
<div class="container-fluid">
        <div id="products" class="section">
           
            <div id="popup" class="popup">
                <div class="popup-content">
                    <h4>Complaint Details</h4>
                    <?php
                        include_once('../connection/connection.php');
                        // Retrieve the complaint ticket number from the database
                        $selectQuery = "SELECT id, category, type, department, nature, image, complain_description, complaint_datetime, complain_user, status, complaint_ticket FROM complain";
                        $selectExe = mysqli_query($con, $selectQuery);
                        ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">S.N.</th>
                                <th style="text-align: center;">Date and Time</th>
                                <th style="text-align: center;">Timeliness</th>
                                <th style="text-align: center;">Category</th>
                                <th style="text-align: center;">Type</th>
                                <th style="text-align: center;">Ticket Number</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <?php
                            $serialNumber = 1; // Initialize the serial number
                            while ($row = mysqli_fetch_assoc($selectExe)) {
                                $statusColor = '';
                                if ($row['status'] === 'pending') {
                                    $statusColor = 'rgb(26, 93, 26)';
                                } elseif ($row['status'] === 'in_progress') {
                                    $statusColor = 'rgb(63, 46, 62)';
                                } elseif ($row['status'] === 'resolved') {
                                    $statusColor = 'rgb(254, 0, 0)';
                                } elseif ($row['status'] === 'discharge') {
                                    $statusColor = 'rgb(117, 194, 246)';
                                } else {
                                    $statusColor = 'gray';
                                }
                            ?>
                        <tr>
                            <td style="text-align: center; color:black; width:50px;"><?php echo $serialNumber; ?></td>
                            <td style=" text-align: center; width:220px;">
                                <?php echo date('Y-m-d h:i A', strtotime($row['complaint_datetime'])) ?></td>
                            <td style="text-align: center; width:180px;"><span class="time-ago"
                                    data-datetime="<?php echo $row['complaint_datetime'] ?>"></span></td>
                            <td style="text-align: center; width:120px;"><?php echo $row['category'] ?></td>
                            <td style="text-align: center; width:120px;"><?php echo $row['type'] ?></td>
                            <td style="text-align: center; width:150px;"><?php echo $row['complaint_ticket'] ?></td>
                            <td style="text-align: center; width: 150px;"><button class="button_Status" type="button"
                                    style="background-color: <?php echo $statusColor; ?>; border: none;"><?php echo $row['status'] ?></button>
                            </td>
                        </tr>
                        <button onclick="openPopup()">Open Popup</button>
                        <?php
                            $serialNumber++; // Increment the serial number for the next row
                        }
                        ?>
                    </table>
                    <button id="closePopup">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'block'; // Change to 'block' to center
        }
        document.getElementById('closePopup').addEventListener('click', function () {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        });
    </script>
<!-- ........................................Popup Section End...................................... -->