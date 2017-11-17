<?php
require 'db_config.php';

  $post = $_POST;

  $sql = "INSERT INTO public.urls VALUES (default,null,null,null,'".$post['urls']."','".$post['title']."','".$post['description']."','".$post['category']."')";


  $result = pg_query($sql);
if($result){
        echo'<script>window.location.href="index_Urls.php"</script>';
    }
    else{
   
        echo'<script>alert("Insert Failed")</script>';
    }
?>
