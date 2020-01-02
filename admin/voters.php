<?php
    
    require('../connection.php');
   /* if(empty($_SESSION['admin_id'])){
      header("location:access-denied.php");
    }*/ 
    $result= mysqli_query($db,"SELECT * FROM tbmembers")
    or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result)<1){
        $result = null;
    }
?>
<?php
if (isset($_POST['Submit']))
{

    $voterfirstname = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
	$voterlastname = addslashes( $_POST['lastname'] );
	$voteremail = addslashes( $_POST['email'] );
	$voterpassword = addslashes( $_POST['password'] );

	$sql = mysqli_query($db,"INSERT INTO tbmembers(first_name,last_name,email,password) VALUES ('$voterfirstname','$voterlastname','$voteremail','$voterpassword')" )
	        or die("Could not insert admin at the moment". mysql_error() );

	// redirect back to manage-admins
	   header("Location:voters.php");
    }
?>

<?php
    // deleting sql query
    // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
     // get id value
     $id = $_GET['id'];
     
     // delete the entry
     $result = mysqli_query($db,"DELETE FROM tbmembers WHERE member_id='$id'")
     or die("The voter does not exist ... \n"); 
     
     // redirect back to candidates
     header("Location: voters.php");
     }
     else
     // do nothing   
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
<CAPTION><h3>ADD NEW VOTER</h3></CAPTION>
<form name="fmvoters" id="fmvoters" action="voters.php" method="post" onsubmit="return positionValidate(this)">
<tr>
	    <td bgcolor="#fefbd8">Voter first Name</td>
	    <td bgcolor="#fefbd8"><input type="text" name="firstname" /></td>
	    
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">voter last Name</td>
	    <td bgcolor="#fefbd8"><input type="text" name="lastname" /></td
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">voter email address</td>
	    <td bgcolor="#fefbd8"><input type="text" name="email" /></td>
	</tr>
	<tr>
	    <td bgcolor="#fefbd8">voter password</td>
	    <td bgcolor="#fefbd8"><input type="password" name="password" /></td>
	</tr>
	<tr>
,	   <td bgcolor="#fefbd8">         </td>
	   <td bgcolor="#fefbd8"><input type="submit" name="Submit" value="Add" /></td>
	</tr>
</table>
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE VOTERS</h3></CAPTION>
<tr>
<th>Voter ID</th>
<th>Voter First Name</th>
<th>Voter Last Name</th>
<th>Voter email</th>
</tr>

<?php
    //loop through all table rows
    while ($row= mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['member_id']."</td>";
    echo "<td>" . $row['first_name']."</td>";
    echo "<td>" . $row['last_name']."</td>";
	echo "<td>" . $row['email']."</td>";
    echo '<td><a href="voters.php?id=' . $row['member_id'] . '">Delete Candidate</a></td>';
    echo "</tr>";
    }
    mysqli_free_result($result);
    //mysqli_close($mysqli);
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








