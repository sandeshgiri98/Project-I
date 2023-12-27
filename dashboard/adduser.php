<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../register/userregister.css">
    <link rel="stylesheet" href="password/style.css">

    <style>
    .error {
        display: none;
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .error.active {
        display: block;
        border-radius: 3px;
        border-color: red;
    }
    </style>
</head>

<body>
    <?php
    include('../dashboard/admin_dash.php')
    ?>
    <div class="main-content">
        <div class="form-content">
            <form id="registration-form" action="user_redirect.php" method="POST" onsubmit="return validateForm()">
                <h3>Add User</h3>

                <div class="textfield">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter Name">
                    <div class="error" id="name-error">Please enter a valid name</div>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter Email">
                    <div class="error" id="email-error">Please enter a valid email address</div>

                    <label for="contact">Contact No</label>
                    <input type="tel" id="contact" name="contact" required placeholder="Enter Phone Number">
                    <div class="error" id="contact-error">Please enter a valid phone number</div>

                    <label for="dob">Date of birth</label>
                    <input type="date" id="dob" name="dob" required>
                    <div class="error" id="dob-error">Please enter date of birth. Age must be at least 14 years or above.</div>

                    <div class="labels">

                        <div class="password-input-container">
                            <label for="password">
                                <h4>Password</h4>
                            </label>
                            <input type="password" id="password" name="password" required placeholder="Password">
                            <button type="button" id="show-password-btn" onclick="togglePasswordVisibility()">
                                <img src="../pop_up/eyeopen.svg" alt="Show Password" id="eye-icon">
                            </button>
                        </div>

                        <div class="error" id="password-error">Use at least 8 characters with Capital letter and special
                            characters like @, !,
                            or # and numbers like 1, 2, or 3</div>
                    </div>

                    <label for="role">Role</label>
                    <select name="role" id="role" class="roles" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <!-- <option value="admin">Admin</option> -->
                    </select>

                </div>
                <input type="submit" name="submit" value="Add User" class="form-button">
            </form>
        </div>
        <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const contact = document.getElementById('contact').value.trim();
            const dob = document.getElementById('dob').value.trim();
            const password = document.getElementById('password').value;
            let valid = true;

            // name
            if (!/^[a-zA-Z\s]+$/.test(name)) {
                valid = false;
                document.getElementById('name-error').classList.add('active');
            } else {
                document.getElementById('name-error').classList.remove('active');
            }

            // email
            if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
                valid = false;
                document.getElementById('email-error').classList.add('active');
            } else {
                document.getElementById('email-error').classList.remove('active');
            }


            // contact
            if (!contact.startsWith('9') || !/^\d{9}$/.test(contact.slice(1))) {
                valid = false;
                document.getElementById('contact-error').classList.add('active');
            } else {
                document.getElementById('contact-error').classList.remove('active');
            }


            // dob
            const currentDate = new Date();
            const dobValue = new Date(dob);
            const diffInYears = (currentDate - dobValue) / (1000 * 60 * 60 * 24 * 365.25);

            if (isNaN(diffInYears) || diffInYears < 14) {
                valid = false;
                document.getElementById('dob-error').classList.add('active');
            } else {
                document.getElementById('dob-error').classList.remove('active');
            }

            // password 
            if (!/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/.test(password)) {
                valid = false;
                document.getElementById('password-error').classList.add('active');
            } else {
                document.getElementById('password-error').classList.remove('active');
            }
            return valid;
        }
        </script>
        <script src="password/showhide.js"></script>
</body>

</html>