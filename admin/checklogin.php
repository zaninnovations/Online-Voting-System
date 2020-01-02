<!DOCTYPE html>
<html>
<body style="background-color:powderblue;">

<?php
//session_start();
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('connection.php');

$tbl_name="tbAdministrators"; // Table name


$myusername = mysqli_real_escape_string($db,$_POST['myusername']);
$mypassword = mysqli_real_escape_string($db,$_POST['mypassword']); 


$sql="SELECT * FROM $tbl_name WHERE email = '$myusername' and password = '$mypassword'";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];


$count=mysqli_num_rows($result);


if($count==1){
    // $user = $result->fetch_assoc();
    // $_SESSION['admin_id'] = $user['admin_id'];
    
                if(isset($_POST['remember']))
                {
                    setcookie('$email',$_POST['myusername'], time()+30*24*60*60); // 30 days
                    setcookie('$pass', $_POST['mypassword'],time()+30*24*60*60); // 30 days
                    $_SESSION['curname']=$myusername;
                    $_SESSION['curpass']=$mypassword;

                    $user = $result->fetch_assoc();
     				$_SESSION['admin_id'] = $user['admin_id'];

                    header("Location:admin.php");
                    exit;
                }
                else
                {
                    $log1=11;
                    $_SESSION['log1'] = $log1;
                    $_SESSION['curname']=$myusername;
                    $_SESSION['curpass']=$mypassword;

                    $user = $result->fetch_assoc();
     				$_SESSION['admin_id'] = $user['admin_id'];

                    header("Location:admin.php");
                    exit;
                }
            

}
else {
    echo "<br> <br> <br> ";
    echo "<center> <h3>Wrong Username or Password<br><br>Return to <a href=\"index.php\">login</a></h3></center>";
}

ob_end_flush();

?> 




</body>
</html>
