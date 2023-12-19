<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>TIMETABLE</title>
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
  <h5 class="card-header">EXAM TIME TABLE</h5>
      <table id="data_table" class="table table-bordered border-dark">
      <form method="POST" action="">
		<thead>
			<tr>
				<th>Date</th>
        <th>Time</th>
				<th>Subject</th>
        <th>Course</th>
     </tr>
		</thead>
		<tbody>
      <tr>
        <form method="POST" action="">
        <td><input type="date" name="date" class="form-control" required></td>
        <td><input type="time" name="time" class="form-control" required></td>
        <td>
          <select name="sub_id" class="form-select" required>
            <option value="">Select Subject</option>
            <?php
              include '../server.php';
              $sql = "SELECT * FROM sub_tb";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo "<option value='".$row['sub_id']."'>".$row['sub_name']."</option>";
              }
            ?>
          </select>
        </td>
        <td>
            <?php
              $ex_name = $_GET['ex_name'];
              include '../server.php';
              $sql = "SELECT exam_id,exam_name FROM exam_tb WHERE exam_name = '$ex_name'";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo $row['exam_name'];
                $exam_id = $row['exam_id'];
              }
            ?>
        </td>
      </tr>
      </tbody>
      </table>
      <div class="card-footer">
      <div class="hstack gap-3">
    <button type="submit" class="btn btn-outline-primary" name="submit">Add Timetable</button>
  <div class="vr"></div>
  <a class='btn btn-outline-secondary' href="add_exam.php">Go back</a>
  </div>
  </div>
  </form>
  </div>

<?php
include '../server.php';
if(isset($_POST['submit'])){
  $date = $_POST['date'];
  $time = $_POST['time'];
  $subject = $_POST['sub_id'];
  $sql = "INSERT INTO x_table_tb (sub_id,exam_id,x_date,time) VALUES ($subject,$exam_id,'$date','$time')";
  $result1 = mysqli_query($conn, $sql);
  if($result1){
    echo "<script>alert('Exam added successfully');</script>";
  }
  else{
    echo "<script>alert('Exam not added');</script>";
  }
}
?>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebars.js"></script>
</body>
</html>
