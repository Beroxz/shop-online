<?php
	session_start();
	session_destroy();
	//header("location:../index.php");
	echo "<script>top.location='./login'</script>";
?>
