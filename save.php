<?php

		require_once('connection.php');
		$candidate_id = $_GET['id'];
		$position = $_GET['position'];
		$member_id=$_SESSION["member_id"];

		$check_result=mysqli_query($db,"select * from tbCandidates where fk_member_id='$member_id' and candidate_position='$position'");
		$count_candidate_vote=mysqli_num_rows($check_result);
		
		if($count_candidate_vote > 0)
		{
			echo "your vote already exist";
		}
		else
		{
			
		$update_query=mysqli_query($db,"UPDATE tbCandidates SET fk_member_id='$member_id', candidate_cvotes=candidate_cvotes+1 WHERE candidate_id='$candidate_id'");
		echo "your vote has been casted";
		}

		mysqli_close($db);
		/*require('connection.php');
        $vote = $_REQUEST['vote'];

        mysqli_query($db,"UPDATE tbCandidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_name='$vote'");

        mysqli_close($db);*/
?> 
