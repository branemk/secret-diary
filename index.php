<?php
session_start();
 $error = "";

if(array_key_exists('logout',$_GET)){
    
    unset($_SESSION['id']);
    setcookie("id","",time()- 60*60);
    $_COOKIE['id']="";
   
    
}else if(array_key_exists('id', $_SESSION) OR array_key_exists('id',$_COOKIE)){
    
    header("Location: loggedin.php");
    
}


if(array_key_exists("submit",$_POST)){
    
   

  
   if(!$_POST['email']){
       $error .= "Please enter email<br>";
   }
      if(!$_POST['password']){
       $error .= "Please enter password<br>";
   }
    
    if($error === ""){
        
       
        
     include("connection.php"); 
//    *********************************************
//        Sign up code
//    *********************************************
         if($_POST['submit']=='Sign up'){
        
                        $query = "SELECT id FROM users WHERE email= '".mysqli_real_escape_string($conn,$_POST['email'])."'";
           
                        $result = mysqli_query($conn, $query);
        
                if(mysqli_num_rows($result) > 0){
            
                        $error .= "User exists";
            
                }else{
                    //    *********************************************
                    //        Save user and password
                    //    *********************************************
                    $insertquery = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($conn,$_POST['email'])."','".mysqli_real_escape_string($conn, $_POST['password'])."')";
            
                            if(!mysqli_query($conn,$insertquery)){
                
                                $error .= "There was an error , please try again later";
                
                            }else{
                                $lastid = mysqli_insert_id($conn);
                                $updatequery = "UPDATE users SET password='".md5(md5($lastid).$_POST['password'])."' WHERE id=".$lastid." LIMIT 1"; 
                
                                mysqli_query($conn, $updatequery);
                
                                $_SESSION['id'] = $lastid;
                
                
                                        if($_POST['stayloggedin'] == 1){
                    
                                            setcookie('id', $lastid, time() + 60*60*24*10);
                                        }
    
                                header("Location: loggedin.php");
                
                                }
                    }
            
            
            mysqli_close($conn);
             
             
//    *********************************************
//        Log in code
//    *********************************************     
        }else if($_POST['submit'] == 'Log in'){
            
        
            
            $loginquery = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($conn,$_POST['email'])."'";
            
            $result = mysqli_query($conn,$loginquery);
             
                if(mysqli_num_rows($result) > 0){
                    
                        $row = mysqli_fetch_array($result);
            
                    if(array_key_exists('id',$row)){
                
                        $hashedpassword = md5(md5($row['id']).$_POST['password']);
                            //    *********************************************
                            //       Check password code
                            //    *********************************************
                            if($hashedpassword == $row['password']){
                        
                                $_SESSION['id'] = $row['id'];
                        
                                    if($_POST['stayloggedin'] == 1){
                                
                                        setcookie('id',$row['id'], time() + 60*60*24*365);
                                
                                    }
                                 
                        
                                header('Location: loggedin.php');
                        
                            }else{
                                    $error .= "Wrong password";
                                    }
                
                    }
            }else{
                $error .= "User does not exists";
            }
        
        }
        
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    
<?php include("header.php") ?>

<body>
      <div id="header" class="container d-flex flex-column justify-content-center align-items-center">
          <h1 class="h1 text-white">Secret Diary</h1>
    </div>
    
    <div id="form" class="container d-flex flex-column justify-content-center align-items-center">
          
        <?php 
        if($error){
            echo " <div class='alert alert-danger' id='error'>$error </div>";
       
        }
        
        ?>

    
    <form method="post">
        <input class="form-control mb-2" type="email" name="email" placeholder="email">
        <input class="form-control mb-2" type="password" name="password" placeholder="password">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="stayloggedin" value=1>
            Stay logged in
        </label>
        <input class="btn btn-success m-1" type="submit" name="submit" value="Sign up">
        <input class="btn btn-success m-1" type="submit" name="submit" value="Log in">


    </form> 

    </div>
</body>
</html>

   