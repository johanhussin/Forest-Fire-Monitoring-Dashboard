<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body>
<?php
	include("conec.php");
   	$link=Conection();
   	$result2=mysqli_query($link,"select * from fcmtoken order by id desc");
	while($row = mysqli_fetch_array($result2))
	{
	printf("<script>
		$.get( 'fire.php', { temp1: 45, moi1: 32, id:'%s' });
		</script>" ,$row["token"]);
	}
	mysqli_free_result($result2);
 ?>
</body>
