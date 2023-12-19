<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Drop Down Sidebar Menu | CodingLab </title>
    <link rel="stylesheet" href="../assets/css/styleo.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styleo.css" rel="stylesheet">
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
        <a href="admin_dash.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admin_dash.php">Dashboard</a></li>
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
          <li><a href="fac_schedule.php">Faculty Schedule</a></li>
          <li><a href="exam_table.php">Exam Schedule</a></li>
          <li><a href="add_schedview.php">Create Schedule</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Exams</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Exams</a></li>
          <li><a href="add_exam.php">New Exam</a></li>
          <li><a href="edit_exam.php">Edit Exam</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Courses</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Courses</a></li>
          <li><a href="add_dep.php">New Departments</a></li>
          <li><a href="add_sub.php">Add Subjects</a></li>
        </ul>
      </li>
     
      <li>
        <a href="./leaves/leavereq.php">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Leave Requests</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="./leaves/leavereq.php">Leave Requests</a></li>
        </ul>
      </li>
      <li>
        <a href="users.php">
          <i class='bx bx-compass' ></i>
          <span class="link_name">Users</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="users.php">Users</a></li>
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
<div class="d-flex flex-column flex-grow-1" style="padding : 30px;">

<div class="card">      	
  <h5 class="card-header">
    ALLOCATION
  </h5>
  
  <form method="POST" action="" style= "padding: 30px; width: 880px;">
  <label class="col-sm-2 col-form-label">Faculty</label>
        <table>
      <tr>
      <select name="fid" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select</option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT fid, fname FROM fac_tb WHERE status='1'";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['fid']."'>".$row['fname']."</option>";
		                        }
		                    	?>
              </select>
    </tr><br>

  <label  class="col-sm-2 col-form-label">Room no</label>
        <table>
      <tr>
      <select name="class_id" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select </option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT class_id,room_no FROM classroom_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['class_id']."'>".$row['room_no']."</option>";
		                        }
		                    	?>
              </select>
    </tr><br>
    <tr>
    <div class="hstack gap-3">
    <button type="submit" class="btn btn-outline-primary" name="allocate">allocate</button>
  <div class="vr"></div>
  <a class='btn btn-outline-secondary' href="add_schedview.php">Go back</a>
</div>
</form>
</tr>
</table>
</div>
<?php
include '../server.php';
if(isset($_REQUEST['allocate'])){
    $table_id=$_GET['table_id'];
    echo $table_id;
    $fid = $_POST['fid'];
    //echo $fid;
    $class_id=$_POST['class_id'];
    //echo $class_id;
   // echo $class_id;
    // $count="SELECT count(*) from leave_list where fid=$fid AND status = '1' AND date = (select x_date from x_table_tb where table_id=$table_id)";
    // $leave_count = mysqli_query($conn, $count);
    // $leave_count = mysqli_fetch_array($conn,$count);
    // if($leave_count ==0 ){
            $insert="INSERT INTO alloc_tb(table_id,fid,class_id) VALUES ($table_id,'$fid','$class_id')";
            echo $insert;
        // echo $fetch_table;
            $result = mysqli_query($conn, $insert);
            if($result){
                    echo "<script>alert('Faculty Allocated Successfully')</script>";
                    echo "<script>window.location.href='add_schedview.php'</script>";
            }
            else{
                    echo "<script>alert('Faculty Allocation Failed')</script>";
                    echo "<script>window.location.href='fac_schedule.php'</script>";
            }
        }
            // else{
            //         echo "<script>alert('Faculty on leave')</script>";
            //         echo "<script>window.location.href='add_sched.php'</script>";
            // }
// }
?>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
