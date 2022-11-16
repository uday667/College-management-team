<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM quiz WHERE quiz_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Quiz record deleted successfully..');</script>";
	}
}
?>
  <section id="contentSection">
    <div class="row">
           <h2>View Quiz</h2>
            <p>View the quiz.</p>
            
         <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:1100px;">
   <thead>
  <tr>
    <th scope="col">User</th>
    <th scope="col">Course</th>
    <th scope="col">Semester</th>
    <th scope="col">Subject</th>
    <th scope="col">Title</th>
    <th scope="col">Questions</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  $sql ="SELECT * FROM quiz";
  $qsql = mysqli_query($con, $sql);
 while($rsrec = mysqli_fetch_array($qsql))
  {
	  $sqluser = "SELECT * FROM user WHERE user_id='$rsrec[user_id]'";
	  $qsqluser = mysqli_query($con,$sqluser);
	  $rsuser = mysqli_fetch_array($qsqluser);
	  
	  $sqlcourse = "SELECT * FROM course WHERE course_id='$rsrec[course_id]'";
	  $qsqlcourse = mysqli_query($con,$sqlcourse);
	  $rscourse = mysqli_fetch_array($qsqlcourse);
	  
	  $sqlsubject = "SELECT * FROM subject WHERE subject_id='$rsrec[subject_id]'";
	  $qsqlsubject = mysqli_query($con,$sqlsubject);
	  $rssubject = mysqli_fetch_array($qsqlsubject);
	  
	  $sqlcount="SELECT count(*) from question WHERE quiz_id='$rsrec[quiz_id]'";
	  $qsqlcount = mysqli_query($con,$sqlcount);
	  $rscount = mysqli_fetch_array($qsqlcount);
	  
	  echo "<tr>
		<td>&nbsp;$rsuser[name]</td>
		<td>&nbsp;$rscourse[course]</td>
		<td>&nbsp;$rsrec[semester]</td>
		<td>&nbsp;$rssubject[subject]</td>
		<td><strong>$rsrec[title]</strong><br />$rsrec[description]</td>
		<td>";
		echo "<a href='questions.php?quizid=$rsrec[quiz_id]' class='btn btn-info'><font color='Red'>Add question</font></a><br />";
		   echo "<a href='viewquestions.php?quizid=$rsrec[quiz_id]' class='btn btn-success'><font color='Blue'>View question</font></a><br /> ($rscount[0] questions) </td>
		<td>&nbsp;";
		
	if($_SESSION['user_type'] == "Staff")
	{
    echo "<a href='quiz.php?editid=$rsrec[quiz_id]'>Edit</a> |";
	}
	echo "<a href='viewquiz.php?delid=$rsrec[quiz_id]' onclick='return deleteconfirm()'>Delete</a></td>
	  </tr>";
  }
  ?>
  </tbody>
 </table>
    </div>
  </section>
 <?php
 include("footer.php")
 ?>
  <script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
 </script>
   <?php
 include("datatables.php");
 ?>