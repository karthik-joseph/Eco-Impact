<?php 
    include 'header.php';
    class CustomException extends Exception {
        public function errorMessage() {
            // Custom error message
            return "Error on line " . $this->getLine() . " in " . $this->getFile() . ": " . 					                    $this->getMessage();
        }
    }

    class DatabaseException extends CustomException {}

    if (isset($_POST['login'])) {
        
        extract($_POST);
        try {
            // Validate inputs
            if (empty($username) || empty($password)) {
                throw new CustomException("Username and password are required.");
            }

            // Prepare and execute the query
            $q = "select * from login where username='$username' and password='$password'";
            $res = select($q);

            if ($res === false) {
                throw new DatabaseException("Database query failed.");
            }

            if (sizeof($res) > 0) {
                $_SESSION['login_id'] = $res[0]['login_id'];
                $login_id = $_SESSION['login_id'];
                
                if ($res[0]['user_type'] == "admin") { // user: admin
                    alert("LOGIN SUCCESS :)");
                    return redirect("admin_home.php");
                } else if ($res[0]['user_type'] == "pending") { // Check if expert is pending approval
                    alert("Your account is pending approval, please wait for admin approval");
                    return redirect("homepage.php");
                } else if ($res[0]['user_type'] == "expert") { // user: expert
                    alert("LOGIN SUCCESS :)");
                    $kk = "select * from expert where login_id='$login_id'";
                    $obj = select($kk);
                    
                    if ($obj === false) {
                        throw new DatabaseException("Database query failed.");
                    }
                    
                    if (sizeof($obj) > 0) {
                        $_SESSION['eid'] = $obj[0]['expert_id'];
                        $eid  = $_SESSION['eid'];
                    }
                    return redirect("experthome.php");
                } else if ($res[0]['user_type'] == 'user') { // user: user
                    alert("LOGIN SUCCESS :)"); 
                    $kk = "select * from users where login_id='$login_id'";
                    $obj = select($kk);
                    
                    if ($obj === false) {
                        throw new DatabaseException("Database query failed.");
                    }

                    if (sizeof($obj) > 0) {
                        $_SESSION['uid'] = $obj[0]['user_id'];
                        $uid  = $_SESSION['uid'];
                    }
                    return redirect("userhome.php");
                }
            } else {
                alert("Invalid username or password");
            }
        } catch (CustomException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (DatabaseException $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        } catch (Exception $e) {
            echo "<script>alert('" . addslashes($e->errorMessage()) . "');</script>";
        }
    }
?>

<script>
   document.addEventListener("DOMContentLoaded", (event) => {
        // Toggle password visibility
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function (e) {
        // Toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle the eye icon
        this.textContent = type === "password" ? "👁️" : "👁️‍🗨️";
    });
   });
</script>

<center class="login-container">
    <h1>Login</h1>
	<form method="post" >
		<table class="table">
			<tr>
                <th>USERNAME:</th>
                <td>
                    <input type="text"  class="form-control" value="" required="" name="username">
                </td>
		    </tr>
		   <tr>
                <th>PASSWORD:</th>
                <td class="password-container">
                    <input type="password" class="form-control"  value="" required name="password" id="password" />
                    <span id="togglePassword" class="eye-icon" style="pointer: cursor;">👁️</span>
                </td>
		   </tr>
		   <tr class="button-container">
		   	    <td colspan="2" align="center">
                    <input class="btn btn-success" type="submit" name="login" value="login">
                </td>
		   </tr>
		   <tr>
		</tr>
		</table>
	</form>
</center>

<script src="js/script.js"></script>
<?php include 'footer.php'?>