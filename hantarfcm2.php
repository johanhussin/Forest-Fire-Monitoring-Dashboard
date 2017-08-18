<?php
   include("conec.php");
   
   //$token = $_GET['token'];
   $link=Conection();
   $Sql="insert into fcmtoken (token)  values ('".$_GET["token"]."')";      
   mysqli_query($link,$Sql);
