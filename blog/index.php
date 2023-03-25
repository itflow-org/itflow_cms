<?php 

$page_title = "Blog";

include("../header.php");

if($config_module_blog_enabled == 0){
  echo "404 Error (Module Not Enabled)";
  exit();
}

//Initialize the HTML Purifier to prevent XSS
require("../plugins/htmlpurifier/HTMLPurifier.standalone.php");
$purifier_config = HTMLPurifier_Config::createDefault();
$purifier_config->set('URI.AllowedSchemes', ['data' => true, 'src' => true, 'http' => true, 'https' => true]);
$purifier = new HTMLPurifier($purifier_config);



  
$query = mysqli_query($mysqli,"SELECT * FROM blog LEFT JOIN users ON blog_by = user_id ORDER BY blog_date DESC LIMIT 5");

while($row = mysqli_fetch_array($query)){

  $blog_id = intval($row['blog_id']);
  $title = htmlentities($row['blog_title']);
  $url_title = htmlentities($row['url_title']);
  $content = $purifier->purify($row['blog_content']);
  $date = htmlentities($row['blog_date']);
  $email = htmlentities($row['user_email']);
  $username = htmlentities($row['user_name']);

?>
  <div class="mb-5">
    <h5 class="text-center text-secondary"><?php echo date("F d, Y", strtotime($date)); ?> <small>by <?php echo $username; ?></small></h5>
    <h1 class="text-center mb-3"><?php echo $title; ?></h1>
    <?php echo $content; ?>
  </div>

<?php 
}
?> 

<?php include("footer.php"); ?>