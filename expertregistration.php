<?php 
    include 'header.php';

    // class files 
    class CustomException extends Exception {
        public function errorMessage() {
            return "Error on line " . $this->getLine() . " in " . $this->getFile() . ": " . $this->getMessage();
        }
    }
    class UsernameExistsException extends CustomException {}
    class InvalidPasswordException extends CustomException {}
    class InvalidPhoneNumberException extends CustomException {}
    class EmailExistsException extends CustomException {}




    if (isset($_POST['submit'])) {
        extract($_POST);



        try {
            // Check if the username already exists
            $checkUsernameQuery = "SELECT * FROM login WHERE username='$uname'";
            $existingUser = select($checkUsernameQuery);
            
            if (sizeof($existingUser) > 0) {
                throw new UsernameExistsException("Username already exists. Please choose a different username.");
            }

             // Check if the email already exists
            $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
            $existingEmail = select($checkEmailQuery);

            if (sizeof($existingEmail) > 0) {
                throw new EmailExistsException("Email already exists. Please use a different email.");
            }
    
            // Validate the password
            $passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/";
            if (!preg_match($passwordPattern, $pas)) {
                throw new InvalidPasswordException("Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be between 8 and 16 characters long.");
            }
    
             // Validate the phone number
            if (!preg_match("/^\d{10}$/", $phn)) {
                throw new InvalidPhoneNumberException("Contact number must be exactly 10 digits long.");
            }


            // insert the values into the database
            $w="insert into login values(null,'$uname','$pas','pending')";
            $t=insert($w);
            $w1="insert into expert values(null,'$t','$fname','$lname','$plc','$phn','$email','$dob')";
            $t1=insert($w1);
            alert("successfully Registered");
            return redirect("login.php");

        } catch (UsernameExistsException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (InvalidPasswordException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (InvalidPhoneNumberException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (EmailExistsException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (CustomException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (Exception $e) {
            echo "<script>alert('An unexpected error occurred: " . addslashes($e->getMessage()) . "');</script>";
        } finally {
            // Reset the form fields
            echo "<script>document.querySelector('form').reset();</script>";
        }
    }
?>

<!-- flatpicker styles and js files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/registration.js"></script>
<link rel="stylesheet" href="css/registration.css?v=<?php echo time(); ?>" />


<section class="registration-container">
    <section class="content-container">
        <center><h1>EXPERT REGISTRATIONS</h1></center>
        <center class="bg">
            <form action="" method="post" class="form-control" enctype="multipart/form-data">
                <table align="center">
                    <tr>
                        <th>First name</th>
                        <td><input type="text" class="form-control" name="fname" placeholder="Enter Your First Name" required></td>
                    </tr>
                    <tr>
                        <th>Last name</th> 
                        <td><input type="text" class="form-control" name="lname" placeholder="Enter Your Last Name" required></td>
                    </tr>
                    <tr>
                        <th>Place</th>
                        <td><input type="text" class="form-control" name="plc" placeholder="Your Place name" required></td>
                    </tr>
                    <tr>
                        <th>Contact No</th>
                        <td><input type="number" class="form-control" max="9999999999" name="phn" pattern="\d{10}" title="Please enter a valid 10-digit phone number" placeholder="Phone No." required>
                    </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="email" class="form-control" name="email" placeholder="Your Email@Id" required></td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td><input type="date" class="form-control" name="dob" placeholder="Select Your Dob" required></td>
                    </tr>
                
                    <tr>
                        <th>User name</th>
                        <td><input type="text" class="form-control" name="uname" placeholder="Name your specified Username" required></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td class="password-container">
                            <input type="password" class="form-control" id="password" name="pas" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}" title="Password must contain at least one uppercase letter, one number, and one special character" placeholder="Set Your Password" required>
                            <span id="togglePassword" class="eye-icon">👁️</span>
                        </td>
                    </tr>
                    <tr>
                    <td align="center" colspan="2" class="button-container"><input type="submit" class="btn " value="REGISTER" name="submit"></td>
                    </tr>
                </table>
            </form>
        </center>
    </section>
</section>


<script src="js/script.js"></script>
<?php include 'footer.php'?>