<?php
    session_start();
    if(array_key_exists('text',$_POST)){
        
        include("connection.php");
        $query = "SHOW TABLES LIKE '" ."userid".$_POST['userid']. "'";
           if (mysqli_num_rows(mysqli_query($conn,$query)) == 1)
        {
                
            
            $insertquery = "INSERT INTO "."userid".$_POST['userid']." (memo) VALUES ("."'".$_POST['text']."'".")";
                 if(mysqli_query($conn,$insertquery)){
                        echo "Memo inserted";
                    }else{
                        echo "Memo is not inserted".$insertquery; 
                        }
        }
    else
    {
          
    
        //$updatequery = "UPDATE users SET text='".$_POST['text']."' WHERE id=".$_SESSION['id']." LIMIT 1";
       $sql = "CREATE TABLE "."userid".$_POST['userid']." (
       id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
       memo TEXT NOT NULL
       )";
        if(mysqli_query($conn,$sql)){
            echo "Tablecreated";
        }else{
            echo "Table not created ".$sql; 
        }
    }
    }

?>
