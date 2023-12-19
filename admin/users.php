<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>USERS</title>
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
  <h5 class="card-header">FACULTY DETAILS</h5>
  
  <table id="data_table" class="table table-bordered border-dark">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Username</th>
				<th>Phone No</th>
				<th>Department</th>
        <th>Designation</th>
        <th>Modify</th>
			</tr>
		</thead>
		<tbody>
        <?php
        include '../server.php';
			$sql_query = "SELECT * FROM fac_tb,dep_tb,desig_tb WHERE fac_tb.depid = dep_tb.depid AND fac_tb.des_id=desig_tb.des_id AND fac_tb.status=1";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $row = mysqli_fetch_assoc($resultset) ) {
			
			    echo "<tr><td>".$row ['fid']."</td>";
			    echo "<td>".$row ['fname']."</td>";
          echo "<td>".$row ['uname']."</td>";
          echo "<td>".$row ['phone']."</td>";
          echo "<td>".$row ['dname']."</td>";
          echo "<td>".$row ['desig_name']."</td>";?>
          <td><form class='form-horizontal' method='post' action=''>
                <input type='hidden' name='fid' value='<?php echo $row['fid']; ?>'>
                <input type='submit' class='btn btn-danger' name='delete' value='Delete'></form></td></tr>
			<?php
      } 
      ?>
		</tbody>
		</table>
    
  </div>
</div>

<?php

      if(isset($_POST['delete'])){
        $fac_id = $_POST['fid'];
        $update = "UPDATE fac_tb SET status='0' WHERE fid=$fac_id";
        $result = mysqli_query($conn,$update);
        if($result){
          echo "<script>alert('Deleted Successfully')</script>";
          echo "<script>window.location.href=''</script>";
        }
        else{
          echo "<script>alert('Failed to Delete')</script>";
          echo "<script>window.location.href=''</script>";
        }
      }
?>
 <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
 <script src="../assets/js/script.js"></script>
</body>
</html>