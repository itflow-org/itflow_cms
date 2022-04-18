<?php 
  include("config.php");

if(isset($_POST['register'])){
    
  $username = strip_tags(mysqli_real_escape_string($mysqli,$_POST['username']));
  $email = strip_tags(mysqli_real_escape_string($mysqli,$_POST['email']));
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $answer = intval($_POST['answer']);
  $ip = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_X_FORWARDED_FOR']));
  $user_agent = strip_tags(mysqli_real_escape_string($mysqli,$_SERVER['HTTP_USER_AGENT']));
  
  if($answer == 8){

    $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email = '$email'");
      
    if(mysqli_num_rows($sql) == 1){
        $response = 
        "<div class='alert alert-danger alert-dismissible fade show'>
          This name has already been taken or you are already registered just not active please give 48 hours for us to approve.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";

        mysqli_query($mysqli,"INSERT INTO events SET event_type = 'Registration Failed', event_details = '$user - $email Registration Failed due to username already taken', event_ip = '$ip', event_user_agent = '$user_agent', event_timestamp = NOW(), user_id = 0");
    }else{   
      mysqli_query($mysqli,"INSERT INTO users SET user_email = '$email', user_name = '$username', user_password = '$password', user_access = $config_module_user_registration_auto_activation_enabled");

      $user_id = mysqli_insert_id($mysqli);

      mysqli_query($mysqli,"INSERT INTO events SET event_type = 'Registration', event_details = '$username - $email Registered', event_ip = '$ip', event_user_agent = '$user_agent', event_timestamp = NOW(), event_user_id = $user_id");

      $response = 
        "<div class='alert alert-success alert-dismissible fade show'>
          You are registered! Goahead and login.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";
    }
  }else{
    $response = 
        "<div class='alert alert-danger alert-dismissible fade show'>
          Incorrect Answer!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";

        mysqli_query($mysqli,"INSERT INTO events SET event_type = 'Registration Failed', event_details = '$username - $email Registration Failed due to incorrect answer of $answer', event_ip = '$ip', event_user_agent = '$user_agent', event_timestamp = NOW(), event_user_id = 0");
  }

}

?>

<?php include("header.php"); ?>

<?php if($config_module_user_registration_enabled == 1){ ?>

<link href="css/signin.css" rel="stylesheet">

<form class="form-signin" method="post">
  <h1 class="h3 mb-3 font-weight-normal text-center">Sign up</h1>
  <?php 
    
  if(isset($response)){
    echo "$response";
  }
    
  ?>
  
  <input type="text" name="username" class="form-control" placeholder="Your Name" required autofocus>
  
  <input type="email"name="email" class="form-control" placeholder="Your Email" required>
  
  <input type="password" name="password" class="form-control" placeholder="Choose a Password" required>
  
  <input type="text" name="answer" class="form-control" placeholder="How many bits are in a Byte?" required>
  
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="register" type="submit">Sign up</button>
</form>

<?php }else{ ?>

404 Error (Module Not Enabled)

<?php } ?>

<?php include("footer.php"); ?>