<?php
session_start();
$uname = $_SESSION['uname'];
if (empty($uname)){
    header("location:../index.html");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>USER DASH</title>
    <link rel="stylesheet" href="../assets/css/styleo.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">MES IDS</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="user_dash.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="user_dash.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Schedules</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Schedules</a></li>
          <li><a href="my_schedule.php">My Schedule</a></li>
          <li><a href="schedule.php">General Schedule</a></li>
        </ul>
      </li>
      <li>
        <a href="timetable.php">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Timetable</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="timetable.php">Timetable</a></li>
        </ul>
      </li>
      <li>
      <li>
        <a href="leave_application.php">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Leave Application</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="leave_application.php">Leave Application</a></li>
        </ul>
      </li>
      <li>
        <a href="leave_status.php">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Leave Status</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="leave_status.php">Leave Status</a></li>
        </ul>
      </li>
    <div class="profile-details">
      <div class="profile-content">
        <i class='bx bx-log-out' id="log_out"></i>
      </div>
      <div class="name-job">
      <div class="profile_name"><?php echo $uname;?></div>
      <?php if($uname == "admin") {
        echo "<div class='job'>Administrator</div>";
      }
        else {
            echo "<div class='job'>Faculty</div>";
            }
        ?>
      </div>
      <li><a href="../logout.php"><i class='bx bx-log-out'></i></a></li>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Menu</span>
    </div>


  <div class="d-flex flex-column flex-grow-1" style="padding-top : 30px;">
  <div class="card">
  <h5 class="card-header">LEAVE APPLICATION</h5>
    <form action="" method="POST">
      <?php
          include '../server.php';
          $fetch = "SELECT fid FROM fac_tb WHERE uname = '$uname'";
          $result = mysqli_query($conn, $fetch);
          while( $row = mysqli_fetch_assoc($result)){
                   $fac_id = $row['fid'];
                   }
        ?>
    <label  class="col-sm-2 col-form-label">Leave Type</label>
        <table>
      <tr>
      <select name="leave_type" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select</option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT id,leave_type FROM leave_type";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['id']."'>".$row['leave_type']."</option>";
		                        }
		                    	?>
              </select>
    </tr><br>
    </table>
    <label  class="col-sm-2 col-form-label">Leave Date</label>
    <table>
      <tr>
      <td><input type="date" name="leave_date" class="form-control" required></td>
      </tr><br>
    </table>
    <label  class="col-sm-2 col-form-label">Reason</label>
    <table>
      <tr>
      <td><textarea name="reason" class="form-control" required></textarea></td>
      </tr><br>
    </table>
    <table>
      <tr>
      <td><input type="submit" name="submit" class="btn btn-primary" value="Submit"></td>
      </tr>
      </table>
    </form>
</div>
</div>

<?php
include '../server.php';
if(isset($_POST['submit'])){
  $leave_type = $_POST['leave_type'];
  $leave_date = $_POST['leave_date'];
  $reason = $_POST['reason'];
  $sql = "INSERT INTO leave_list (fid,leave_type_id,date,reason,status,date_created,date_approved) VALUES ($fac_id,$leave_type,'$leave_date','$reason',0,CURRENT_TIMESTAMP(),NULL)";
  $result = $conn->query($sql);
  if($result){
    echo "<script>alert('Leave Application Submitted Successfully')</script>";
  }
  else{
    echo "<script>alert('Leave Application Not Submitted')</script>";
  }
}
?>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>