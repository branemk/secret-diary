<?php
    session_start();
    
    if(array_key_exists('id',$_COOKIE)){
       
       
        $_SESSION['id'] = $_COOKIE['id'];
        
        
        
    }

    if(array_key_exists('id',$_SESSION)){
        
             
        include("connection.php");
        
//    *******************************************************************
//        We are getting user id to use to create table with user memos
//        We are putting the value of id in hidden element
//    *******************************************************************
        $id = $_SESSION['id'];
        
    }else{
        
        header("Location: index.php");
        
    }



?>

    <!DOCTYPE html>
    <html lang="en">
    <?php include("header.php") ?>

    <body>
            <div id="hidden">
            <?php echo $id; ?>
        </div>
        <div class="container-fluid">



            <nav class="navbar navbar-inverse fixed-top bg-inverse">

                <ul class="navbar-nav flex-row">
                    <li class="nav-item mr-auto">


                        <button id="create" class="  btn btn-success" data-toggle="modal" data-target="#myModal">Create New</button>
                    </li>
                    <li class="nav-item">

                        <button class='btn btn-outline-success '><a href='index.php?logout=1'>Log out</a></button>
                    </li>
                </ul>

            </nav>

        </div>
    
        <div id="textcontainer" class="container-fluid d-flex justify-content-center align-items-center">
            <div id="textcontainerrow" class="row d-flex  justify-content-center align-items-center">
            
            </div>
        </div>



        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Memo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                    </div>
                    <div class="modal-body">
                        <textarea id="textmodal" rows="10" maxlength="1000"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="modaldelete" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="modalsave" type="button" class="btn btn-primary">Save</button>
                        <button id="modalupdate" type="button" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="script.js">


        </script>
    </body>

    </html>
