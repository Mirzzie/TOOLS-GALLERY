<?php
session_start();
include "../server.php";
$uname = $_SESSION['uname'];
if (empty($uname)){
  header("location:../index.html");
}
if($uname){
  $fetch = "SELECT fid FROM fac_tb WHERE uname = '$uname'";
  $result = mysqli_query($conn, $fetch);
  while( $record = mysqli_fetch_assoc($result))
  {
  $fac_id = $record['fid'];
  }
}
  $sql_query = "SELECT * FROM  leave_list ll, leave_type lt WHERE ll.fid = $fac_id AND ll.leave_type_id = lt.id";
  $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
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
    <div class="card-body">
        <h5 class="card-title">LEAVE STATUS</h5>
      <table id="data_table" class="table table-bordered border-dark">
		<thead>
			<tr>
      <th>Leave Date</th>
      <th>Leave Type</th>
      <th>Leave Reason</th>
      <th>Leave Status</th>
     </tr>
		</thead>
		<tbody>
  <?php
include '../server.php';
while( $record = mysqli_fetch_assoc($resultset) ) {
?>
            <tr>
               <td><?php echo $record ['date']; ?></td>
               <td><?php echo $record ['description']; ?></td>
               <td><?php echo $record ['reason']; ?></td>
               <td class="text-center">
								<?php if($record['status'] == 0): ?>
									<span class="badge text-bg-secondary">Pending</span>
								<?php elseif($record['status'] == 1): ?>
									<span class="badge text-bg-success">Approved</span>
								<?php elseif($record['status'] == 2): ?>
									<span class="badge text-bg-danger">Declined</span>
								<?php endif; ?>
							</td>
           </tr>
           <?php } ?>
      </tbody>
   </table>
   </div>
 </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
