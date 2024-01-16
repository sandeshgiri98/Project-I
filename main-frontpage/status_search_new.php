 <html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Results</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
       <link rel="stylesheet" href="css/textt.css">
    </head>

    <!-- <style>
    .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;

    }
    </style> -->
    <style>
     .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .popup-content {
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Additional styles for your popup content */
        #complaintStatusMessage {
            font-size: 16px;
            margin-top: 20px;
        }
</style>
    <boby>


       
<!--        <h1>Search Results !!</h1>
        
        <fieldset>
          <legend align="center"><span class="number">1</span>Your Search Information</legend>
    -->      
   <?php
//$conn = mysqli_connect("localhost","root","root","complaint_nitc17") or die("data base not connected");
include_once('../connection/connection.php');

   
    $cid = $_POST['cid'];
    $sql = "SELECT status FROM complain WHERE complaint_ticket = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $complaintID);
    $stmt->execute();
    $stmt->bind_result($status);

    // Check if a row was found
    if ($stmt->fetch()) {
        // Display the status
        $complaintStatus = "Complaint Status: " . $status;
    } else {
        // No matching complaint found
        $complaintStatus = "Complaint not found";
    }

    // Close the statement
    $stmt->close();
?>
                    
                        
        </fieldset>
      </form>
      
    </body>
</html>

<div id="complaintStatusPopup">
    <div class="popup-content">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <div id="complaintStatusMessage"></div>
    </div>
</div>



 

    <script>
    // Function to open the popup with the complaint status message
    function showPopup(event) {
        event.preventDefault(); // Prevent the form from submitting

        var popup = document.getElementById('complaintStatusPopup');
        var messageDiv = document.getElementById('complaintStatusMessage');

        // Replace the content of complaintStatusMessage with the status message
        messageDiv.innerHTML = "<p>Checking complaint status...</p>";

        // Display the popup and dim the background
        popup.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Disable scrolling

        // Simulate the form submission and fetch the status
        var complaintID = document.querySelector('input[name="cid"]').value;
        fetchStatus(complaintID); // Replace with actual code to fetch status
    }

    // Function to close the popup
    function closePopup() {
        var popup = document.getElementById('complaintStatusPopup');
        popup.style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scrolling
    }

    // Simulated function to fetch the complaint status
    function fetchStatus(complaintID) {
        // Simulate an AJAX request to fetch the status
        setTimeout(function () {
            var status = "Complaint Status: Resolved"; // Replace with actual status

            var messageDiv = document.getElementById('complaintStatusMessage');
            messageDiv.innerHTML = "<p>" + status + "</p>";
        }, 2000); // Simulate a delay of 2 seconds (replace with actual AJAX request)
    }
</script>

<?php
include_once('../connection/connection.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input (you may need to improve this)
    $complaintID = filter_input(INPUT_POST, "cid", FILTER_SANITIZE_STRING);

    // Prepare and execute the SQL query with a prepared statement
    $sql = "SELECT status FROM complain WHERE complaint_ticket = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $complaintID);
    $stmt->execute();
    $stmt->bind_result($status);

    // Check if a row was found
    if ($stmt->fetch()) {
        // Display the status
        $complaintStatus = "Complaint Status: " . $status;
    } else {
        // No matching complaint found
        $complaintStatus = "Complaint not found";
    }

    // Close the statement
    $stmt->close();
}
?>
