<?php
require 'db_config.php';

  $post = $_POST;

  $sql = "INSERT INTO public.categories VALUES (default,'".$post['topic']."','".$post['title']."','".$post['description']."')";


  $result = pg_query($sql);
if($result){
        echo'<script>window.location.href="index_Categories.php"</script>';
    }
    else{
   
        echo'<script>alert("Insert Failed")</script>';
    }
?>
