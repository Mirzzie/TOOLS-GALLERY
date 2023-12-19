<?php
session_abort();
session_start();
if(isset($_REQUEST['sign'])){
include 'server.php';
if(isset($_SESSION['uname'])){
  //header('location: ./user/user_dash.php?uname=$_SESSION['uname']');
}
  // assign user input to variables - $uname and $pass

  $uname = filter_var ($_REQUEST['uname']);
  $pass = filter_var ($_REQUEST['pass']);

  // Check if it's the administrator and redirects to admin dashboard

  if($uname == 'admin' && $pass == 'admin'){
    $_SESSION['uname'] = $uname;
    header("location: ./admin/admin_dash.php?uname=$uname");
  }
  // Check if user inputs are empty

  if(!(empty($uname)) && !(empty($pass))){

    $sql = "SELECT * FROM fac_tb WHERE uname = '$uname' AND passw = '$pass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      $_SESSION['uname'] = $uname;
      header("location: ./user/user_dash.php?uname=$uname");
    }
    else{
      echo "<script>alert('User Not Resgistered. Please Sign Up to continue');</script>";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/stylee.css?<?php echo time(); ?>" />
    <title>IDS login</title>
    <link rel="icon" href="assets/images/logo/Codemaster.svg" type="image/jpg" />
  </head>
  <body>
  <?php
			if(isset($_REQUEST['msg'])){
				echo "<p class='alert alert-warning'>".$_REQUEST['msg']."</p>";
			}

			if(isset($error)){
				echo "<p class='alert alert-danger'>".$error."</p>";
			}
		?>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

        <!-- SIGN IN FORM -->
          <form action="#"  method="POST" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="uname" placeholder="Username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="pass" placeholder="Password" required/>
            </div>
             <input type="submit" value="Login" name="sign" class="btn solid"/>
          </form>

          <!-- SIGN UP FORM -->
          <form action="#"  method="POST" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="fname" placeholder="Name" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" name="uname" placeholder="Username" required  pattern="[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$+@"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" name="phone" placeholder="Phone"  pattern="^\d{10}$" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="pass" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <select name="depid" class="input-field" aria-label="Default select example" required>
                        <option selected value="">Select Department</option>
                        <?php
                         include 'server.php';
		                       	$sql = "SELECT depid, dname FROM dep_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['depid']."'>".$row['dname']."</option>";
		                        }
		                    	?>
              </select>
             </div>
             <div class="input-field">
              <i class="fas fa-lock"></i>
             <select name="des_id" class='input-field' required>
                        <option selected value="">Select Designation</option>
                        <?php
                         include 'server.php';
		                       	$sql = "SELECT des_id, desig_name FROM desig_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['des_id']."'>".$row['desig_name']."</option>";
		                        }
		                    	?>
                    </select>
               </div><br><br><br>
            <input type="submit" class="btn" name="up" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              create an account to access all the features of the system.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="assets/images/logo/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              if you already have an account, just sign in.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="assets/images/logo/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="assets/js/main.js"></script>
  </body>
</html>
<?php
if(isset($_REQUEST['up'])){
  if($_POST)
    {
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $des = $_POST['des_id'];
        $dep = $_POST['depid'];
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        include 'server.php';
        $query = "INSERT INTO fac_tb (phone,des_id,depid,fname,uname,passw,status) VALUES($phone,'$des','$dep','$fname','$uname','$pass',1)";
                $result = mysqli_query($conn, $query);
                  if($result)
                    {
                      echo "<script>alert('Successfully Registered! Login in to Continue')</script>";
                    }
                   else
                     {
                       echo "<script>alert('Registration Failed !')</script>";
                   }
            }
          }
?>
