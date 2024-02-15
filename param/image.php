<?php
    include_once('./../config/mysql.php');
  

      if(isset($_GET['path'])){
  
        $type=$_GET['type'];
        header("content-type: $type");
        echo file_get_contents($_GET['path']);
      }else{
          die("Impossible d'accder à cette page");
      }
     
  


?>