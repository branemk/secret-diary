<?php
    session_start();
    if(array_key_exists('text',$_POST)){
        
        include("connection.php");
        
        $updatequery = "UPDATE userid".$_POST['userid']." SET memo='".$_POST['text']."' WHERE id=".$_POST['id']." LIMIT 1";
        
        if(mysqli_query($conn,$updatequery)){
            echo "Update Sucessfull";
        }else{
             echo "Update unsucessfull";
        }
    }

?>