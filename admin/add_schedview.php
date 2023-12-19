<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>SCHEDULE</title>
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
<div class="d-flex flex-column flex-grow-1" style="padding-top : 30px;">
  <div class="card">
  <h5 class="card-header">
    CREATE SCHEDULE
  </h5>
  <form method="POST" action="" style= "padding: 30px; width: 880px;">
  <label for="inputPassword" class="col-sm-2 col-form-label">Name of the Examination</label>
        <table>
      <tr>
      <select name="exam_id" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Select</option>
                        <?php
                         include '../server.php';
		                       	$sql = "SELECT exam_id, exam_name FROM exam_tb";
		                        $result = $conn->query($sql);
		                        while ($row=$result->fetch_assoc()){
		                          echo "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
		                        }
		                    	?>
              </select>
    </tr><br>
    <tr>
    <button type="submit" class="btn btn-primary mb-3" name="view">View Timetable</button>
    </form>
    </tr>
    </table>
    </div>
    
<?php
include '../server.php';
if(isset($_REQUEST['view'])){
      echo "<div class='card'>";
      echo"<h5 class='card-header'>EXAM TIMETABLE</h5>";
      echo "<table id='data_table' class='table table-bordered border-dark'>";
		  echo "<thead><tr>";
			echo	"<th>Date</th>";
      echo "<th>Time</th>";
			echo	"<th>Course</th>";
      echo "<th>Subject</th>";
      echo "<th>Action</th>";
      echo "</tr></thead>";
        $exam_id = $_POST['exam_id'];
        $fetch_table="SELECT * FROM exam_tb,x_table_tb, dep_tb,sub_tb WHERE dep_tb.depid= sub_tb.depid AND sub_tb.sub_id= x_table_tb.sub_id AND exam_tb.exam_id=$exam_id AND x_table_tb.exam_id=$exam_id";
        // echo $fetch_table;
        $result = mysqli_query($conn, $fetch_table);
        if($result->num_rows == 0){
          echo "<tbody><tr>";
          echo "<td colspan='5'>No Timetable Found</td>";
          echo "</tr></tbody>";
        }
        else{
        while($row=$result->fetch_assoc()){
          $table_id = $row['table_id'];
          echo "<tbody><tr>";
          echo "<td>".$row['x_date']."</td>";
          echo "<td>".$row['time']."</td>";
          echo "<td>".$row['dname']."</td>";
          echo "<td>".$row['sub_name']."</td>";
          echo "<td><a class='btn btn-outline-primary' href='allocate.php?table_id=$table_id'>allocate</a></td>";
          echo "</tr></tbody>";
        }
      }
 echo "</table></div>";
  }
?>
</div>


<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>