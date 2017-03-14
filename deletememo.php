<?php
    session_start();
    if(array_key_exists('userid',$_POST)){
        
        include("connection.php");
        
        $updatequery = "DELETE FROM userid".$_POST['userid']." WHERE id=".$_POST['id']." LIMIT 1";
        
        if(mysqli_query($conn,$updatequery)){
            echo "Delete Sucessfull";
        }else{
             echo "Delete unsucessfull";
        }
    }

?>