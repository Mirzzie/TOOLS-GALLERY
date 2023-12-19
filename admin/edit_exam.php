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
  <div class="d-flex flex-column flex-grow-1" style="overflow: auto; padding : 10px;">
  <?php
  include '../server.php';
  $fetch_exam = "SELECT * FROM exam_tb WHERE status='1'";
  $exam = mysqli_query($conn,$fetch_exam);
  if(mysqli_num_rows($exam) > 0){
    while($row = mysqli_fetch_array($exam)){
      $exam_id = $row["exam_id"];
      $exam_title= $row["exam_name"];
?>
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <?php echo $exam_title; ?>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="card">
       <table id="data_table" class="table table-bordered border-dark">
		   <thead>
			 <tr>
				<th>Date</th>
        <th>Time</th>
				<th>Course</th>
        <th>Subject</th>
        <th>Modify</th>
      </tr>
		 </thead>
		 <tbody>
			<?php
      include '../server.php';
      $sql_query = "SELECT * FROM sub_tb, dep_tb, x_table_tb, exam_tb WHERE sub_tb.sub_id = x_table_tb.sub_id AND x_table_tb.exam_id = exam_tb.exam_id AND dep_tb.depid = sub_tb.depid AND exam_tb.exam_id = '$exam_id'";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
      if($resultset->num_rows == 0){
        echo "<tbody><tr>";
        echo "<td colspan='5'>No Timetable Found</td>";
        echo "</tr></tbody>";
      }
      else{
			while( $row = mysqli_fetch_assoc($resultset) ) {
			?>
			   <tr id="<?php echo $row ['table_id']; ?>">
         <td><?php echo $row ['x_date']; ?></td>
			   <td><?php echo $row ['time']; ?></td>
			   <td><?php echo $row ['dname']; ?></td>
			   <td><?php echo $row ['sub_name']; ?></td>
               <td><form class="form-horizontal" method="post" action=''>
                        <input type="hidden" name="table_id" value="<?php echo $row['table_id']; ?>">
                        <input type='submit' class='btn btn-outline-primary' name='modify' value='update'>
                        <input type='submit' class='btn btn-danger' name='delete' value='Delete'>
                        </form></td>
			   </tr>
			<?php }
      } ?>
		 </tbody>
		 </table>
     <?php
     if(isset($_POST['modify'])){
      echo "<div class='card'>";
      echo "<h6 class='card-header'>Update Exam</h6>";
          echo "<table id='data_table' class='table table-bordered border-dark'>";
          echo "<form method='POST' action=''>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>Date</th>";
            echo "<th>Time</th>";
            echo "<th>Course</th>";
            echo "<th>Subject</th>";
         echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          echo "<tr>";
            echo"<form method='POST' action=''>";
            echo "<td><input type='date' name='date' class='form-control' required></td>";
            echo"<td><input type='time' name='time' class='form-control' required></td>";
            echo "<td>";
            echo "<select name='sub_id' class='form-select' required>";
            echo "<option value=''>Select Course</option>";
                  include '../server.php';
                  $sql = "SELECT depid,dname FROM dep_tb";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='".$row['depid']."'>".$row['dname']."</option>";
                  }
                
            echo "</td>";
            echo "<td>";
              echo "<select name='sub_id' class='form-select' required>";
                echo "<option value=''>Select Subject</option>";
               
                  include '../server.php';
                  $sql = "SELECT * FROM sub_tb";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<option value='".$row['sub_id']."'>".$row['sub_name']."</option>";
                  }
           
              echo "</select>";
            echo "</td>";
          echo "</tr>";
          echo "</tbody>";
          echo "</table>";
          echo "<div class='card-footer'>";
          echo "<div class='hstack gap-3'>";
        echo "<button type='submit' class='btn btn-outline-primary' name='submit'>Update</button>";
      echo "</div>";
      echo "</form>";
      echo "</div>";
    }
    ?>
     </div>
     </div>
     </div>
    </div>
   <?php
        }
    }
                      

    if(isset($_POST['delete'])){
        $table_id = $_POST['table_id'];
        echo $table_id;
        $delete = "DELETE * FROM x_table_tb WHERE table_id=$table_id";
        $result = mysqli_query($conn,$delete);
        if($result){
            echo "<script>alert('Deleted Successfully')</script>";
            echo "<script>window.location.href='edit_exam.php'</script>";
        }
        else{
            echo "<script>alert('Failed to Delete')</script>";
            echo "<script>window.location.href='edit_exam.php'</script>";
        }
    }
    ?>
    

    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</main>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

      <script src="../assets/js/script.js"></script>
  </body>
</html>