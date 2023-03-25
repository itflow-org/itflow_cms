<?php 

include("config.php");
  
if(isset($_POST['login'])){

  session_start();

  $email = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['email'])));
  $password = trim($_POST['password']);

  $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email = '$email' AND user_access > 0");
  $row = mysqli_fetch_array($sql);
  if(password_verify($password, $row['user_password'])){
    $_SESSION['logged'] = TRUE;
    $_SESSION['user_id'] = intval($row['user_id']);
    $_SESSION['user_access'] = intval($row['user_access']);
    header("Location: index.php");
  }else{
    $response = 
    "<div class='alert alert-danger alert-dismissible fade show'>
      Invalid username or password. If you just registered your account please give 48 hours for us to approve.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
  }
}

?>

<?php include("header.php"); ?>

<?php if($config_module_user_registration_enabled == 1){ ?>

<link href="css/signin.css" rel="stylesheet">

<form class="form-signin" method="post">
  <h1 class="h3 mb-3 font-weight-normal text-center">Sign in</h1>
  <?php 
    
  if(isset($response)){
    echo htmlentities($response);
  }
    
  ?>
  <label for="inputEmail" class="sr-only">Username</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
</form>

<?php }else{ ?>

404 Error (Module Not Enabled)

<?php } ?>

<?php include("footer.php"); ?>