<?php
function Conection(){
   if (!($link=mysqli_connect("YOUR_HOSTNAME_HERE","YOUR_USERNAME_HERE","YOUR_PASSWORD_HERE")))  {
      exit();
   }
   if (!mysqli_select_db($link,"sensor_data")){
      exit();
   }
   return $link;
} 
?>
