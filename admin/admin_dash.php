<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>ADMIN DASHBOARD</title>
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
    <?php
  //fetch card data
  include "../server.php";
  $sql = "SELECT * from fac_tb WHERE status = '1'";
  $avail_fac_count = mysqli_query($conn,$sql);
  
  include "../server.php";
  $sql = "SELECT * from exam_tb ";
  $exam_count = mysqli_query($conn,$sql);

?>

  <div class="row">
    <div class="column">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><b>Exams</b></h5>
          <h6 class="card-subtitle mb-2 text-muted">Ongoing</h6>
          <p class="card-text"><?php echo mysqli_num_rows($exam_count); ?></p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card">
        <div class="card-body">
        <h5 class="card-title"><b>Faculties</b></h5>
        <h6 class="card-subtitle mb-2 text-muted">Total</h6> 
        <p class="card-text"><?php echo mysqli_num_rows($avail_fac_count); ?></p>
      </div></div>
    </div>

  <div class="d-flex flex-column flex-grow-1" style="padding :30px; overflow: auto; ">
  
  <div class="card">
  <h5 class="card-header">Upcoming Examinations</h5>
    
    <div class="table-responsive">
      <table class="table table-bordered border-dark">
        <thead>
          <tr>
            
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Name of Examination</th>
            
          </tr>
        </thead>
        <tbody>

		<?php
      include '../server.php';
      $sql_query = "SELECT * FROM exam_tb WHERE status='1'";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $row = mysqli_fetch_assoc($resultset) ) {
			?>
			   <tr id="<?php echo $row ['exam_id']; ?>">
         <td><?php echo $row ['start_date']; ?></td>
			   <td><?php echo $row ['end_date']; ?></td>
			   <td><?php echo $row ['exam_name']; ?></td>
			   </tr>
			<?php } ?>
          
        </tbody>
      </table>
    </div>
</div>
</div>
  </section>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/script.js"></script>

</body>
</html>
