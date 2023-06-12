<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel | PlugNPlay</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <style>
    body {
      background-color: #f8f9fa;
    }
    
    .navbar {
      background-color: #343a40;
      color: #fff;
    }
    
    .navbar-brand {
      font-weight: bold;
    }
    
    .navbar-nav .nav-link {
      color: #fff;
    }
    
    .navbar-nav .nav-link:hover {
      color: #ccc;
    }
    
    .sidebar {
      background-color: #343a40;
      color: #fff;
      min-height: 100vh;
    }
    
    .sidebar .list-group-item {
      background-color: transparent;
      border: none;
      color: #fff;
    }
    
    .sidebar .list-group-item:hover {
      background-color: #343a40;
      color: #ccc;
    }
    
    .content {
      background-color: #fff;
      padding: 20px;
    }
  </style>
</head>
<body>
<?php
    if(!isset($_COOKIE['admin'])){
        die('<h3 style="color: red;">Access Denied!</h3>');
    }
?>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="adminPanel.php#dashboard">Dashboard</a>
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
    </div>
  </nav>

  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-lg-3 sidebar">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
          <a href="#" class="list-group-item list-group-item-action">Videos</a>
          <a href="#" class="list-group-item list-group-item-action">Users</a>
        </div>
      </div>
      <div class="col-lg-9 content">
        <h1>Dashboard</h1>
        <h2>Videos</h2>
        <div class="row">
          <div class="col-lg-6" id="videos">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Video Title</h5>
                <p class="card-text">Video Description</p>
                <a href="#" class="btn btn-primary mr-2">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        
        
        <h2>Users</h2>
        <div class="row" id="users">
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">User Name</h5>
                <p class="card-text">User Email</p>
                <a href="#" class="btn btn-primary mr-2">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
        
        <h2>Video Upload</h2>
        <form>
          <div class="form-group">
            <label for="videoTitle">Title</label>
            <input type="text" class="form-control" id="videoTitle" placeholder="Enter video title">
          </div>
          <div class="form-group">
            <label for="videoDescription">Description</label>
            <textarea class="form-control" id="videoDescription" rows="3" placeholder="Enter video description"></textarea>
          </div>
          <div class="form-group">
            <label for="videoFile">File</label>
            <input type="file" class="form-control-file" id="videoFile">
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
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
          } 
          else {
            alert("Error: " + xhr.status);
          }
        }
      };
      
      xhr.send("value=" + encodeURIComponent(value));
    }
  </script>
</html>
