<?php
    ini_set ("display_errors", "1");
			error_reporting(E_ALL);
			ob_start();

			
			require_once('connection.php');
            $result= mysqli_query($db,"SELECT * FROM tbpositions")
            or die("There are no records to display ... \n" . mysqli_error());
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
<script type="text/javascript">
function getVote(id,position)
{

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

	if(confirm("Are you sure to cast this vote"))
	{

 xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
       }
	    };
	xmlhttp.open("GET","save.php?id="+id+"&position="+position,true);
	xmlhttp.send();
	}
	else
	{
	alert("Choose another candidate ");
	}

}

function getPosition(String)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","vote.php?position="+String,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
/*$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })

    });
   j('.refresh').css({color:"green"});
});*/
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
    <!-- ################################################################################################ -->
	<div id="logo" class="fl_left">
      <h1><a href="index.html">ONLINE VOTING</a></h1>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="voter.php">Home</a></li>
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>

<div >
	<table width="380" align="center">
	<CAPTION><h3>CURRENT POLLS</h3></CAPTION>
	<form name="fmvote" id="fmvote" action="vote.php" method="post" onsubmit="return positionValidate(this)">
	
	<table border="0" width="420" align="center">
	<tr>
		<td><h3>CHOOSE POSITION</h3></td>
        <td><SELECT NAME="position" id="position" onclick="getPosition(this.value)">
        <OPTION VALUE="select">select
        <?php
         //loop through all table rows
         while ($row=mysqli_fetch_array($result)){
            echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
            
         }
        ?>
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Candidates" /></td>
    </tr>
    <tr>
</form>

</table>
<table width="270" align="center">
<tr>
<?php
      if(isset($_POST['submit'])){
      $selected_position = $_POST['position'];  // Storing Selected Value In Variable
      echo "You have selected :" .$selected_position;  // Displaying Selected Value
}
?>
</tr>
<form name="candidate" id="candidate" action="vote.php" method="post" onsubmit="return positionValidate(this)">
<table border="0" width="420" align="center">
<tr>
		<th>Candidate Name</th>
		<th>Candidate Position</th>
		<th>Cast Vote</th>
		</tr>
<?php
//loop through all table rows
//if (mysql_num_rows($result)>0){
  if (isset($_POST['Submit']))
  {
	    $position = addslashes( $_POST['position'] ); 
       
       
       $result1 = mysqli_query($db,"SELECT * FROM tbCandidates WHERE candidate_position='$position'")
       or die(" There are no records at the moment ... \n"); 
	   
	   
          while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
          echo "<tr>";
          echo "<td>" . $row['candidate_name']."</td>";
		  echo "<td>" . $row['candidate_position']."</td>";
          echo "<td><input type='radio' id='radbtn' name='$row[candidate_position]' value='$row[candidate_id]'  onclick='getVote(this.value,this.name)' /></td>";
          echo "</tr>";
          }
          mysqli_free_result($result1);
          mysqli_close($db);
//}
  }
   else
    // do nothing
?>

</form>
</table>
<tr>
    <h3>NB: Click a circle under a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</h3>
</tr>
</table>
</div>

<?php include("footer.php"); ?>

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