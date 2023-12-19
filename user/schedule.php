<?php
session_start();
$uname = $_SESSION['uname'];
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
        <h5 class="card-title">GENERAL SCHEDULE</h5>
      <table id="data_table" class="table table-bordered border-dark">
		<thead>
			<tr>
      <th>Date</th>
      <th>Time</th>
      <th>Exam</th>
      <th>Faculty</th>
      <th>Room</th>
     </tr>
		</thead>
		<tbody>
			<?php
      include '../server.php';
      $sql_query = "SELECT al_id,x_table_tb.x_date,x_table_tb.time, exam_tb.exam_name, alloc_tb.fid, fac_tb.fname, classroom_tb.room_no FROM alloc_tb LEFT JOIN (
        x_table_tb LEFT JOIN exam_tb
        ON exam_tb.exam_id = x_table_tb.exam_id)
        ON alloc_tb.table_id =x_table_tb.table_id
        LEFT JOIN fac_tb
        ON alloc_tb.fid = fac_tb.fid
        LEFT JOIN classroom_tb
        ON classroom_tb.class_id = alloc_tb.class_id";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $row = mysqli_fetch_assoc($resultset) ) {
			?>
			   <tr id="<?php echo $row ['al_id']; ?>">
                <td><?php echo $row ['x_date']; ?></td>
                <td><?php echo $row ['time']; ?></td>
                <td><?php echo $row ['exam_name']; ?></td>
                <td><?php echo $row ['fname']; ?></td>
                <td><?php echo $row ['room_no']; ?></td>
            </tr>
            <?php } ?>
		</tbody>
		</table>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>