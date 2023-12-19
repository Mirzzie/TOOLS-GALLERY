<?php 
    include '../server.php';
    $course=$_GET['id'];
    $exam=$_GET['exam'];
        $fetch_sem="SELECT sem_id FROM exam_tb WHERE exam_id='$exam'";
        $result = $conn->query($fetch_sem);
        $row=$result->fetch_assoc();
		    $sem= $row['sem_id'];
		
		       
		$sql = "SELECT sub_id, sub_name FROM sub_tb WHERE depid='$course' and sem_id='$sem'";  //AJAX
	    $result1 = $conn->query($sql);
		while ($row=$result1->fetch_assoc()){
		    echo "<option value='".$row['sub_id']."'>".$row['sub_name']."</option>";
		}
		                    
?>