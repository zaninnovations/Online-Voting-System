<?php
	
	require('../connection.php');
	//retrive positions from the tbpositions table
	$result=mysqli_query($db,"SELECT * FROM tbadministrators")
	or die("There are no records to display ... \n" . mysql_error()); 
	if (mysqli_num_rows($result)<1){
	    $result = null;
	}
	?>
	<?php
	// inserting sql query
	if (isset($_POST['Submit']))
	{

	$adminfirstname = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
	$adminlastname = addslashes( $_POST['lastname'] );
	$adminemail = addslashes( $_POST['email'] );
	$adminpassword = addslashes( $_POST['password'] );

	$sql = mysqli_query($db,"INSERT INTO tbadministrators(first_name,last_name,email,password) VALUES ('$adminfirstname','$adminlastname','$adminemail','$adminpassword')" )
	        or die("Could not insert admin at the moment". mysql_error() );

	// redirect back to manage-admins
	   header("Location:manage-admins.php");
	}
?>
<?php
	// deleting sql query
	// check if the 'id' variable is set in URL
	/* if (isset($_GET['id']))
	 {
	 // get id value
	 $id = $_GET['id'];
	 
	 // delete the entry
	 $result = mysqli_query($db,"DELETE FROM tbadministrators WHERE admin_id='$id'")
	 or die("The admin does not exist ... \n"); 
	 
	 // redirect back to positions
	   header("Location: manage-admins.php");
	 }
	 else
	 // do nothing*/
    
?>

<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/user.js">
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
	<table width="380" align="center">
	<CAPTION><h3>ADD NEW ADMIN</h3></CAPTION>
	<form name="fmadmins" id="fmadmins" action="manage-admins.php" method="post" onsubmit="return positionValidate(this)">
	<tr>
	    <td bgcolor="#fefbd8">Admin first Name</td>
	    <td bgcolor="#fefbd8"><input type="text" name="firstname" /></td>
	    
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">admin last Name</td>
	    <td bgcolor="#fefbd8"><input type="text" name="lastname" /></td
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">admin email address</td>
	    <td bgcolor="#fefbd8"><input type="text" name="email" /></td>
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">admin password</td>
	    <td bgcolor="#fefbd8"><input type="password" name="password" /></td>
	</tr>
	<tr>
,	   <td bgcolor="#fefbd8">         </td>
	   <td bgcolor="#fefbd8"><input type="submit" name="Submit" value="Add" /></td>
	</tr>
	</table>

	<table border="0" width="420" align="center">
		<CAPTION><h3>AVAILABLE ADMINS</h3></CAPTION>
		<tr>
		<th>Admin ID</th>
		<th>Admin Name</th>
		<th>Admin Email</th>
		</tr>

		<?php
			//loop through all table rows
			while ($row=mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['admin_id']."</td>";
			echo "<td>" . $row['first_name']."</td>";
			echo "<td>" . $row['email']."</td>";
			//echo '<td><a href="manage-admins.php?id=' . $row['admin_id'] . '">Delete admin</a></td>';
			echo "</tr>";
			}
			mysqli_free_result($result);
			//mysqli_close($link);
		?>

	</table>
	<hr>
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