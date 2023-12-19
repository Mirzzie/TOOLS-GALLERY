<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>NEW EXAMINATION</title>
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
  <div class="d-flex flex-column flex-grow-1" style="padding: 30px; overflow:auto;">
  
  <div class="card">
  <h5 class="card-header">EXAM DETAILS</h5>

  <form method="POST" action="" style= "padding: 30px; width: 880px;">
  
  <label for="inputPassword" class="col-sm-2 col-form-label">Name of the Examination</label>
        <table>
      <tr>
      <input type="text" class="form-control"  name="ex_name" required>
    </tr>
    <label for="inputPassword" class="col-sm-2 col-form-label">Semester</label>
    <tr>
    <select name="sem_id" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select </option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT sem_id,sem_name FROM sem_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['sem_id']."'>".$row['sem_name']."</option>";
		                        }
		                    	?>
      </select>
    </tr>
      <label for="inputPassword" class="col-sm-2 col-form-label">Start Date</label>
        <tr>
      <input type="date" class="form-control"  name="s_date" required>
    </tr>
      <label for="inputPassword" class="col-sm-2 col-form-label">End Date</label>
        <tr>
      <input type="date" class="form-control"  name="e_date" required>
    </tr>
    <br>
    <tr>
    <button type="submit" class="btn btn-primary mb-3" name="sub">SUBMIT</button>
    </form>
    </tr>
    </table>
    </div>

<!-- edit exam -->

<div class="card">
  <h5 class="card-header">TIME TABLE DETAILS</h5>

  <form method="POST" action="" style= "padding: 30px; width: 880px;">
  
  <label for="inputPassword" class="col-sm-2 col-form-label">Name of the Examination</label>
        <table>
      <tr>
      <select name="ex_name" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select </option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT exam_id, exam_name FROM exam_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
                              $ex_name=$row['exam_name'];
		                        }
		                    	?>
      </select>
    <label for="inputPassword" class="col-sm-2 col-form-label">Semester</label>
    <tr>
    <select name="sem_id" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select </option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT sem_id,sem_name FROM sem_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['sem_id']."'>".$row['sem_name']."</option>";
                              $sem_id=$row['sem_id'];
		                        }
		                    	?>
      </select>
    </tr>
    <tr>
    <br>
    <button type="submit" class="btn btn-primary mb-3" name="view">VIEW TABLE</button>
    </form>
    </tr>
    </table>
    </div>


<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>

<?php
include '../server.php';
if(isset($_REQUEST['sub'])){
if($_POST){
        $ex_name = $_POST['ex_name'];
        $s_date = $_POST['s_date'];
        $e_date = $_POST['e_date'];
        $sem_id = $_POST['sem_id'];
        $sql = "SELECT * FROM exam_tb WHERE exam_name = '$ex_name'";
        $result0 = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result0) > 0){
          while($row = mysqli_fetch_assoc($result0)){
            if($row['exam_name'] == $ex_name && $row['sem_id'] == $sem_id){
              echo "<script>alert('Examination Already Exists!');</script>";
            }
          }
        }
      else{
        $query = "INSERT INTO exam_tb (exam_name,start_date,end_date,sem_id,status) VALUES('$ex_name','$s_date','$e_date','$sem_id','1')";
                $result = mysqli_query($conn, $query);
                if($result)
                {
                  echo "<script>alert('Examination Added !');</script>";
                  echo "<script>window.location.replace('timetable.php?ex_name=$ex_name');</script>";
               }
                else
                {
                  echo "<script>alert('Failed to Add Examination!');</script>";
                }
    }
    }
  }
?>
<?php
include '../server.php';
if(isset($_REQUEST['view'])){
if($_POST){
        $ex_name = $_POST['ex_name'];
        $sem_id = $_POST['sem_id'];
        $sql = "SELECT * FROM exam_tb WHERE exam_id = '$ex_name'";
        $result0 = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result0) > 0){
          while($row = mysqli_fetch_assoc($result0)){
            if($row['exam_id'] == $ex_name && $row['sem_id'] == $sem_id){
              echo "<script>window.location.replace('timetable.php?ex_name=$ex_name');</script>";
            }
          }
        }
      else{
        echo "<script>alert('Examination Not Found!');</script>";
    }
    }
  }
?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>