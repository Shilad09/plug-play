<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel | PlugNPlay</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

      * {
          font-family: 'Poppins', sans-serif;
      }
    </style>
</head>

<body>
    <?php
    if(!isset($_COOKIE['admin'])){
        die('<h3 style="color: red;">Access Denied!</h3>');
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">&nbsp;<i class="fa-solid fa-headphones"></i>
                &nbsp;Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="adminPanel.php#videos">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                    <?php
            session_start();
            $_SESSION['admin_check'] = $_COOKIE['admin'];
            // session_destroy();
          ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminPanel.php#users">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" onclick="sendData()">Logout</a>
                    <?php
            if(isset($_POST['value'])){
                $cookieName = 'admin';
                $cookiePath = '/';
                setcookie($cookieName, '', time() - 1, $cookiePath);
                session_unset();
                exit();
            }
          ?>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    error_reporting(0);
    $target_dir = "uploads/";
    $filename = basename($_FILES['fileUpload']['name']);
    $targetfilepath = $target_dir . $filename;
    $filetype = pathinfo($targetfilepath, PATHINFO_EXTENSION);
    $maxSize = 500*1024*1024;
    
    ini_set('post_max_size', '550M');
    ini_set('upload_max_filesize', '500M');
    ini_set('max_execution_time', 600);
    ini_set('max_input_time', 600);
    ini_set('memory_limit', '512M');
    if(isset($_POST['submit']) && !empty($_FILES['fileUpload']['name']) && ($_FILES['fileUpload']['size'] <= $maxSize)){
        $allowType = array('mp4', 'avi', '3gp', 'gif');

        if(in_array($filetype, $allowType)){
            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetfilepath)){
                $name = $_POST['fileUpload'];
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "videos";
                              
                $connn = mysqli_connect($servername, $username, $password, $dbname);
                              
                if (!$connn) {
                    die("Failed to connect: " . mysqli_connect_error());
                }
                $sql = "INSERT INTO `videoplayer` (`name`,`title`, `description`) VALUES ('$filename', '$title', '$desc')";
                if(!mysqli_query($connn, $sql)){
                    die('error');
                    }
                    else{
                      header('location: adminPanel.php');
                      exit();
                    }
            }
        }
    }
    ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Upload Videos
                    </div>
                    <div class="card-body">
                        <form method="post" action="adminPanel.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="videoTitle">Title</label>
                                <input type="text" class="form-control" name="title" id="videoTitle" placeholder="Enter video title">
                            </div>
                            <div class="form-group">
                                <label for="videoDescription">Description</label>
                                <textarea class="form-control" name="desc" id="videoDescription" rows="3"
                                    placeholder="Enter video description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="videoFile">File</label>
                                <input type="file" class="form-control-file" name="fileUpload" id="videoFile" accept="video/*">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-6">
                <div class="card" id="videos">
                    <div class="card-header">
                        List of Videos
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              $servername = "localhost";
                              $username = "root";
                              $password = "";
                              $dbname = "videos";
                              
                              $con = mysqli_connect($servername, $username, $password, $dbname);
                              
                              if (!$con) {
                                  die("Failed to connect: " . mysqli_connect_error());
                              }
                              $sql = "SELECT * FROM `videoplayer`";
                              $res = mysqli_query($con, $sql);

                              if(mysqli_num_rows($res) > 0){
                                while($roww =  mysqli_fetch_assoc($res)){
                                  $videoURL = 'uploads/'. $roww['name'];
                                  echo "<tr>
                                  <td><video controls height='150' width='200' controlsList='nodownload'>
                                  <source src=".$videoURL." type='video/mp4'>
                                  </video></td>
                                  <td>
                                      <p><b>Title: </b>".$roww['title']."</p>
                                      <p><b>Uploaded on: </b>".$roww['date']."</p>
                                      <a href='#' class='btn btn-sm btn-primary'>Edit</a>
                                      <a href='#' class='btn btn-sm btn-danger'>Delete</a>
                                  </td>
                              </tr>";
                                }
                              }

                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                <div class="card mt-4" id="users">
                <div class="card-header">
                    List of Users
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          require 'dbconnect.php';
                          $sql = "SELECT * FROM `registration`";
                          $result =  mysqli_query($conn, $sql);
                          if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                              echo "<tr>
                              <td>".$row['name']."</td>
                              <td>".$row['username']."</td>
                              <td>".$row['date']."</td>
                          </tr>";
                            }
                           }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<script>
function sendData() {
    var value = 1;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "adminPanel.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                // alert(response);
            } else {
                alert("Error: " + xhr.status);
            }
        }
    };

    xhr.send("value=" + encodeURIComponent(value));
}
</script>

</html>