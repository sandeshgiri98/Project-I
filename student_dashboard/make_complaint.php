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
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
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
  transition: all 0.8s
}

#closePopup:active:after {
  padding: 0;
  margin: 0;
  opacity: 1;
  transition: 0s
}
</style>

<body>
    <?php include_once("../student_dashboard/student_dash.php"); ?>
    <div class="main-content">
        <div class="container-fluid">

            <div id="products" class="section">
                <div class="main">
                    <div id="products" class="section">
                        <section class="main">
                            <section class="Products">
                                <div class="product-details">
                                    <div class="product-adding-form">
                                        <ol class="breadcrumb mb-4">
                                            <li class="breadcrumb-item active"><b>Complaint Form</b></li>
                                        </ol>
                                        <div class="col-lg-10">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="card shadow-lg border-0 rounded-lg mt-5">


                                                        <form action="redirect.php" method="POST" id="product_form"
                                                            onsubmit="return confirmSubmission();">
                                                            <!------------------------------------------------------------------------------------------------->
                                                            <div class="product-form-fill">
                                                                <div class="brand_info">
                                                                    <div class="complaint_category">
                                                                        <label for="complaint_category"><b>Complaint
                                                                            Category</b></label>
                                                                        <select id="complaint_category"
                                                                            name="complaint_category" required>
                                                                            <option value="" disabled selected>Select
                                                                            </option>
                                                                            <option value="Technical">Technical</option>
                                                                            <option value="Non-technical">Non-technical
                                                                            </option>
                                                                            <option value="Teaching">Teaching</option>
                                                                            <option value="Non-teaching">Non-teaching
                                                                            </option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <!------------------------------------------------------------------------------------------------->
                                                                    <div class="complaint_type">
                                                                        <label for="complaint_type"><b>Complaint
                                                                            Type:</b></label>
                                                                        <select id="complaint_type"
                                                                            name="complaint_type" required>
                                                                            <option value="" disabled selected>Select
                                                                            </option>
                                                                            <option value="Hardware">Hardware</option>
                                                                            <option value="Software">Software</option>
                                                                            <option value="Network">Network</option>
                                                                            <option value="Facilities">Facilities
                                                                            </option>
                                                                            <option value="Curriculum">Curriculum
                                                                            </option>
                                                                            <option value="Administration">
                                                                                Administration</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br />

                                                                <!------------------------------------------------------------------------------------------------->
                                                                <label for="name"><b>Nature of Complaint</b></label>
                                                                <input type="text" id="name" name="name"
                                                                    placeholder="Nature of Complaint type"
                                                                    oninput="updateCharacterCount(this)" maxlength="20"
                                                                    required />
                                                                <span><span id="natureNum">0</span>/20</span>
                                                                <br />

                                                                <!------------------------------------------------------------------------------------------------->
                                                                <div class="display_types">
                                                                    <div class="dis_type">
                                                                        <label for="complaint_department"><b>Complaint
                                                                            Department:</b></label>
                                                                        <select id="complaint_department"
                                                                            name="complaint_department" required>
                                                                            <option value="" disabled selected>Select
                                                                            </option>
                                                                            <option value="IT">IT Department</option>
                                                                            <option value="HR">HR Department</option>
                                                                            <option value="Finance">Finance Department
                                                                            </option>
                                                                            <option value="Operations">Operations
                                                                                Department</option>
                                                                            <option value="Academics">Academics
                                                                                Department</option>
                                                                            <option value="Administration">
                                                                                Administration Department
                                                                            </option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="photo">
                                                                        <br />
                                                                        <h1>Upload Product Photo</h1>
                                                                        <input type="file" id="photoInput" name="image"
                                                                            accept="image/*" />

                                                                    </div>
                                                                </div>


                                                                <label for="description"><b>Enter Your Complaint in 500
                                                                    words</b></label>
                                                                <textarea name="description" id="field"
                                                                    oninput="countChar(this)" maxlength="500"
                                                                    placeholder="Enter your description here..."
                                                                    required></textarea>

                                                                <span><span id="charNum">0</span>/500</span>

                                                                <script>
                                                                function countChar(val) {
                                                                    var len = val.value.length;
                                                                    if (len >= 500) {
                                                                        val.value = val.value.substring(0, 500);
                                                                        len =
                                                                        500; // Update the length to 500 if it exceeds the limit
                                                                    }
                                                                    document.getElementById('charNum').textContent =
                                                                    len;
                                                                }
                                                                </script>
                                                                <br>
                                                                <label for="Complaint">Complaint By:</label>
                                                                <input disabled type="text" class="not-allowed"
                                                                    name="complain"
                                                                    value="<?php echo $row['fake_user']; ?>"
                                                                    style="width:100px; text-align:center; cursor: not-allowed; margin-bottom:10px; color:red; font-weight:bold"
                                                                    readonly disabled>
                                                                <input type="hidden" name="complaint"
                                                                    value="<?php echo $row['fake_user']; ?>">


                                                                <br>
                                                                <input type="submit" value="Submit" name="submit"
                                                                    class="button" />

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!------------------------------------------------------------------------------------------------->

                                    </div>
                                    </form>
                                </div>
                    </div>
                    </section>
                    </section>
                </div>
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <h4>Complaint Submitted!</h4>

                        <?php
                        include_once('../connection/connection.php');
                        
                        // Retrieve the complaint ticket number from the database
                        $fakeUserID = $_SESSION['fake_user'];
                        $selectQuery = "SELECT complaint_ticket FROM complain WHERE complain_user = '$fakeUserID' ORDER BY id DESC LIMIT 1";
                        $selectExe = mysqli_query($con, $selectQuery);
                        
                        if ($selectExe && mysqli_num_rows($selectExe) > 0) {
                            $row = mysqli_fetch_assoc($selectExe);
                            $complaint_ticket = $row['complaint_ticket'];
                            echo "<p>Your complaint ticket number is <span id='ticketNumber'>$complaint_ticket</span>.</p>";
                        } else {
                            echo "<p>Error retrieving complaint ticket number.</p>";
                        }
                        ?>
                        <button id="closePopup">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <script>
        function showPopup(ticketNumber) {
            var popup = document.getElementById('popup');
            var ticketNumberSpan = document.getElementById('ticketNumber');
            ticketNumberSpan.textContent = ticketNumber;
            popup.style.display = 'flex';
        }

        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // After submitting the form, show the popup
        <?php
        if (isset($_GET['complaint_ticket'])) {
            echo "showPopup('" . $_GET['complaint_ticket'] . "');";
        }
        ?>
        </script>

        <script src="validation.js"></script>
        <script>
        function confirmSubmission() {
            var confirmation = confirm("Do you want to submit the Complaint?");

            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
        // Display a message
        var urlParams = new URLSearchParams(window.location.search);
        var message = urlParams.get('message');
        if (message) {
            document.getElementById('messageContainer').innerText = message;
        }
        </script>

    </div>
    </div>
    <script>
    function confirmSubmission() {
        var confirmation = confirm("Do you want to submit the Complaint?");

        if (confirmation) {
            return true;
        } else {
            return false;
        }
    }
    // Display a message
    var urlParams = new URLSearchParams(window.location.search);
    var message = urlParams.get('message');
    if (message) {
        document.getElementById('messageContainer').innerText = message;
    }
    </script>

    <script>
    // JavaScript code for character count validation
    function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
            val.value = val.value.substring(0, 500);
            len = 500; // Update the length to 500 if it exceeds the limit
        }
        document.getElementById('charNum').textContent = len;
    }
    </script>
    <script>
    function updateCharacterCount(inputElement) {
        const maxLength = parseInt(inputElement.getAttribute('maxlength'));
        const currentLength = inputElement.value.length;

        const characterCountSpan = document.getElementById('natureNum');
        characterCountSpan.textContent = currentLength;

        if (currentLength > maxLength) {
            inputElement.value = inputElement.value.substring(0, maxLength);
            characterCountSpan.style.color = 'red';
        } else {
            characterCountSpan.style.color = 'black';
        }
    }
    </script>
    <script>
    function showPopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'flex';
    }

    document.getElementById('closePopup').addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
    });

    // After submitting the form, show the popup
    <?php
    if (isset($_GET['complaint_submitted'])) {
        echo "showPopup();";
    }
    ?>
    </script>
</body>

</html>