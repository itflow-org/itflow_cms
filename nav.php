<?php $query = mysqli_query($mysqli,"SELECT page_title FROM pages WHERE page_active = 1 ORDER BY page_order ASC"); ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php"><?php echo $config_site_name; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <?php 

      while($row = mysqli_fetch_array($query)){
      
      $title = $row['page_title'];
    
      ?>

      <li class="nav-item">
        <a class="nav-link <?php if($_GET["page"] == $title) { echo "active"; } ?>" href="index.php?page=<?php echo $title; ?>"><?php echo ucwords($title); ?></a>
      </li>

      <?php } ?>

      <?php if($config_module_docs_enabled == 1){ ?>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "docs.php") { echo "active"; } ?>" href="docs.php">Docs</a>
      </li>
      <?php } ?>
      <?php if($config_module_forum_enabled == 1){ ?>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "forums.php" OR basename($_SERVER["PHP_SELF"]) == "post_details.php" OR basename($_SERVER["PHP_SELF"]) == "new_topic.php") { echo "active"; } ?>" href="forums.php">Forums</a>
      </li>
      <?php } ?>
      <?php if($config_module_blog_enabled == 1){ ?>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "blog.php") { echo "active"; } ?>" href="blog.php">Blog</a>
      </li>
      <?php } ?>
    </ul>
    
    <?php if($config_module_user_registration_enabled == 1){ ?>

    <?php if(!$_SESSION['logged']){ ?>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "register.php") { echo "active"; } ?>" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "login.php") { echo "active"; } ?>" href="login.php">Login</a>
      </li>
    </ul>
    <?php }else{ ?>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          <i class="fas fa-fw fa-user"></i> <?php echo $session_username; ?>
        </a>
        
        
        <div class="dropdown-menu dropdown-menu-right">
          <?php if($session_user_access == 9){ ?>
          <a class="dropdown-item" href="admin">Admin</a>
          <div class="dropdown-divider"></div>
          <?php } ?>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
    <?php 
    } 
    }
    ?>
  </div>
</nav>