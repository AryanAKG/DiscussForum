<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>letsDiscuss Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result= mysqli_query($conn, $sql);
    while($row= mysqli_fetch_assoc($result)){
        $catname= $row['category_name'];
        $catdesc= $row['category_description'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method== 'POST'){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        $th_title= $_POST['title'];
        //securing threath_title input from XSS attack
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        
        $th_desc = $_POST['desc'];
        //securing th_desc input from XSS attack
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert=true;
                if($showAlert){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added. Please wait till someone respond to it.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
        }        
    }
    ?>

    <!-- category container start -->
    <div class="container my-3">

        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?></h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.</p>
            <a class="btn btn-success btn-lg" href="#footer" role="button">Click to reach last thread</a>
        </div>
    </div>    

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
       echo '<div class="container" id="foot">

            <h1>Start Discussion</h1>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="title">
                    <input type = "hidden" name = "sno" value = "' . $_SESSION['sno'] . '">
                    <small id="emailHelp" class="form-text text-muted">Keep your title brief and crisp.</small>
                </div>
                <div class="form-group">
                    <label for="desc">Elaborate your Concern</label>
                    <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
         </div>';
        }
        else{
            echo '<div class="container">
            <h1 class="py-2">Start a Thread</h1>
            <p class="lead">You are not logged in. Please login to start discussion.</p>
            </div>';
        }
        
         ?>   
         <div class="container">
            <h1 class="py-2"> Browse Threads</h1>

            <?php
            $id= $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id= $id";
            $result = mysqli_query($conn, $sql);
            $noResult=true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult=false;
                $title = $row['thread_title'];
                $id = $row['thread_id'];
                $desc = $row['thread_desc'];
                $thread_time = $row['timestamp'];
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT username FROM `users` WHERE sno = '$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                
            echo '<div class="media my-3">
                <img src="images/download.png" class="mr-3" alt="user image" id="userimage">
                <div class="media-body">
                <p class="font-weight-bold mt-0">' . $row2['username'] . ' at ' . $thread_time . '</p>
                <h5 class="mt-0"><a class="text-dark" href = "thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                    <p>' . $desc . '</p><hr>
                </div>
            </div>';

            }
            
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Threads Found</p>
                  <p class="lead">Be the first person to ask doubt!.</p>
                </div>
              </div>';
            }

            ?>


        </div>
    
    <?php include 'partials/_footer.php';?>
    <!-- category container ends -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

</body>

</html>