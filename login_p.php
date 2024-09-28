<?php 
  session_start();
  require_once ('config/db_user.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
      <form action="login_db.php" method="post" class="box-from">
      <?php if(isset($_SESSION['error'])){ ?>
          <div class="alert alert-danger" role="alert">
            <?php 
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
          </div>
        <?php }?>
        <?php if(isset($_SESSION['warning'])){ ?>
          <div class="alert alert-warning" role="alert">
            <?php 
              echo $_SESSION['warning'];
              unset($_SESSION['warning']);
            ?>
          </div>
        <?php }?>
        <?php if(isset($_SESSION['success'])){ ?>
          <div class="alert alert-success" role="alert">
            <?php 
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?>
          </div>
        <?php }?>
        <h2 class="text-center">Login Page</h2>
        <hr>
        <div class="from-group mt-3" >
          <label for="login_username">Username</label>
          <input type="text" class="form-control" name="login_username" aria-describedby="login_username" placeholder="Enter username" require/>
        </div>
        <div class="from-group mt-3">
          <label for="login_password">Password</label>
          <input type="password" class="form-control" name="login_password" aria-describedby="login_password" placeholder="Password" require/>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-danger mt-3" name="login">Login</button>
        </div>
      </form>
      <hr>
      <p>If don't have account yet? Let's click here <a href="signup_p.php">Sign Up</a></p> 
    </div>
</body>
</html>