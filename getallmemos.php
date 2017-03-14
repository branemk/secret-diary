<?php

    session_start();
    if(array_key_exists('userid',$_POST)){
        
        include("connection.php");
        
         $query = "SELECT * FROM userid".$_POST['userid']."";
            //echo $query;
        
       if( $result = mysqli_query($conn,$query)){
           
            if(mysqli_num_rows($result) == 1){ $columns = 12;}
            
            if(mysqli_num_rows($result) == 2){ $columns = 6;}
                
            if(mysqli_num_rows($result) > 2){ $columns = 3;}
        while($row = mysqli_fetch_array($result)){
            
           
            //echo $row['memo'];
        echo      "<div class='textcontainer p-5 col-md-".$columns." d-flex  flex-column justify-content-center align-items-center'>

            <div id='textarea".$row['id']."' class='textarea'>
                <p class='textparagraph'>".htmlspecialchars($row['memo'])."</p>
            </div>

            <button id='editbutton".$row['id']."' class='editbutton btn btn-outline-success'>Edit</button>
        </div>";
            
           
        }
       }else{
           echo "error ".$query;
       }
    }

?>