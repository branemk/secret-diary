 <?php 
//        *****************************************************************
//            Use your own username and password
//        *****************************************************************
        $conn = mysqli_connect('localhost','username','pass','username');
        
        if(mysqli_connect_error()){
            die("Error connecting to database");
        }
        
        ?>