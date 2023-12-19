<?php
session_start();
$uname = $_SESSION['uname'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>FACULTY SCHEDULE</title>
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
  <div class="d-flex flex-column flex-grow-1" style="padding : 20px; overflow: auto">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Faculty Schedule</h3>
      <table id="data_table" class="table table-bordered border-dark">
		<thead>
			<tr>
        <th>ID</th>
				<th>Date</th>
        <th>Time</th>
        <th>Exam</th>
				<th>Faculty</th>
        <th>Room</th>
        <th>Modify</th>
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
        ON classroom_tb.class_id = alloc_tb.class_id;";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
      if($resultset->num_rows == 0){
        echo "<tbody><tr>";
        echo "<td colspan='5'>No Allocations Found</td>";
        echo "</tr></tbody>";
      }
      else{
			 while( $row = mysqli_fetch_assoc($resultset) ) {
			 ?>
			   <tr id="<?php echo $row ['al_id']; ?>">
                <td><?php echo $row ['al_id']; ?></td>
                <td><?php echo $row ['x_date']; ?></td>
                <td><?php echo $row ['time']; ?></td>
                <td><?php echo $row ['exam_name']; ?></td>
                <td><?php echo $row ['fname']; ?></td>
                <td><?php echo $row ['room_no']; ?></td>
                <td><form class="form-horizontal" method="post"action=''>
                        <input type="hidden" name="al_id" value="<?php echo $row['al_id']; ?>">
                        <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                        <input type='submit' class='btn btn-outline-primary' name='Re-allocate' value='Change'>
                        </form></td>
			   </tr>
            </tr>
            <?php }} ?>
      <?php
      if(isset($_POST['Re-allocate'])){
        $al_id = $_POST['al_id'];
        echo "<script>window.location.href='re_allocate.php?al_id=$al_id'</script>";
      }

      if(isset($_POST['delete'])){
        $al_id = $_POST['al_id'];
        $delete = "DELETE FROM alloc_tb WHERE al_id='$al_id'";
        $result = mysqli_query($conn,$delete);
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
		</tbody>
		</table>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>