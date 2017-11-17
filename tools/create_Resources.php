<?php
require 'db_config.php';

  $post = $_POST;

  $sql = "INSERT INTO public.resources VALUES (default,'".$post['topic']."','".$post['title']."','".$post['description']."')";


  $result = pg_query($sql);
if($result){
        echo'<script>window.location.href="index_Resources.php"</script>';
    }
    else{
   
        echo'<script>alert("Insert Failed")</script>';
    }
?>
