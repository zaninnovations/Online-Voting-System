<?php
require_once('../connection.php');
// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){   

if(isset($_POST['publish'])){
$publish=$_POST['publish'];
$_SESSION['publish']=$publish;

if($_SESSION['publish'] == "publish"){


 $position = addslashes( $_POST['position'] );

  
  
  $result_candidates = mysqli_query($db,"SELECT `candidate_id`,`fk_member_id`,`candidate_name`,`candidate_position`,@candvotes := `candidate_cvotes` AS 'candidate_cvotes' ,
  (SELECT @total := sum(`candidate_cvotes`) FROM tbCandidates) AS 'total', (@candvotes/@total)*100 AS 'percentage' FROM tbCandidates where candidate_position='$position'");
    //$row_candidates = mysqli_fetch_array($result_candidates,MYSQLI_ASSOC);
	while($row_candidates = mysqli_fetch_array($result_candidates,MYSQLI_ASSOC))
	{
		$candidates_array[]=[
	'candidate_name' => $row_candidates['candidate_name'],
	'candidate_cvotes' => $row_candidates['candidate_cvotes'],
	'total' => $row_candidates['total'],
	'percentage' => $row_candidates['percentage'],
	];
	}
}
}
	
//
else
{
	unset ($_SESSION['publish']);
	$_SESSION['publish']='';
}

 
 
  
   /* $results = mysqli_query($db,"SELECT * FROM tbCandidates where candidate_position='$position'");

    while(mysqli_num_rows($results)){
		  $row = mysqli_fetch_array($results);
	      $candidate_name[] = $row['candidate_name'];
	      $candidate_cvotes[] = $row['candidate_cvotes'];
	} */
   // $row2 = mysqli_fetch_array($results); // for the second candidate
      /*if ($row1){
      $candidate_name_1=$row1['candidate_name']; // first candidate name
      $candidate_1=$row1['candidate_cvotes']; // first candidate votes
      }*/

 //     if ($row2){
 //     $candidate_name_2=$row2['candidate_name']; // second candidate name
 //     $candidate_2=$row2['candidate_cvotes']; // second candidate votes
 //     }

}  
?> 
<?php
// retrieving positions sql query
$positions= mysqli_query($db,"SELECT * FROM tbPositions")
or die("There are no records to display ... \n"); 
?>


<!DOCTYPE html>

<html>
<head>
<title>online voting</title>


<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/admin.js">
</script>

</head>
<body id="top">

<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
  
    <div class="fl_left">
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-pinterest" href="https://uk.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
        <li><a class="faicon-twitter" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-rss" href="https://www.rss.com/"><i class="fa fa-rss"></i></a></li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace inline pushright">
        <li><i class="fa fa-phone"></i> +923022382470</li>
        <li><i class="fa fa-envelope-o"></i> k163962@nu.edu.pk</li>
		<li><i class="fa fa-envelope-o"></i> k163923@nu.edu.pk</li>
		<li><i class="fa fa-envelope-o"></i> k163927@nu.edu.pk</li>
      </ul>
    </div>
   
  </div>
</div>

<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    
    <div id="logo" class="fl_left">
      <h1><a href="index.html">ONLINE VOTING</a></h1>
    </div>
    
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="admin.php">Home</a></li>
        <li><a class="drop" href="#">Admin Panel Pages</a>
          <ul>
            <li><a href="manage-admins.php">Manage Admin</a></li>
            <li><a href="positions.php">Manage Positions</a></li>
            <li><a href="candidates.php">Manage Candidates</a></li>
			<li><a href="voters.php">Manage Voters</a></li>
            <li><a href="refresh.php">Results</a></li>
          </ul>
        </li>
        
        <li><a href="http://localhost/online_voting/index.php">Voter Panel</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    
  </header>
</div>

<div >
 
  <div >
    <table width="420" align="center">
    <form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
    <tr>
        <td style="color:#000000";>Choose Position</td>
        <td><SELECT NAME="position" id="position">
        <OPTION  VALUE="select"><p style="color:black";>select</p>
        <?php 
        //loop through all table rows
        while ($row= mysqli_fetch_array($positions)){
          echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
        }
        ?>
        </SELECT></td>
        <td style="color:black";><input type="submit" name="Submit" value="See Results" /></td>
    </tr>
	<tr>
		<td bgcolor="#fefbd8">Do You want to publish the result</td>
		 <td bgcolor="#fefbd8"></td>
		  <td bgcolor="#fefbd8"><input type="checkbox" name="publish" value="publish" /></td>
		 </tr>
    <tr>
     
        
    </tr>
	
    </table>
    </form> 
	
	
    <?php
if(isset($candidates_array))
{
	foreach($candidates_array as $key => $candidates_row){
		if($key % 2 === 0)
		{
		echo "
		".$candidates_row['candidate_name']."<br>
    <img src='images/candidate-1.gif'
    width='10'
    height='10'>
    ".number_format($candidates_row['percentage'], 2)." % of ".$candidates_row['total']." total votes
    <br>".$candidates_row['candidate_cvotes']." votes <br><br>";
		}
		else
		{
			echo "
		".$candidates_row['candidate_name']."<br>
    <img src='images/candidate-2.gif'
    width='10'
    height='10'>
    ".number_format($candidates_row['percentage'], 2)." % of ".$candidates_row['total']." total votes
    <br>".$candidates_row['candidate_cvotes']." votes <br><br>";
		}
	}
}
	?>
    
  </div>

</div>


<?php include("../footer.php"); ?>



<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>

