<?php include("header.php"); ?>

<?php
  
if(isset($_GET['page'])){

  $page_title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_GET['page'])));

  if(preg_match('/[^a-z_\-0-9]/i', $page_title)){
    echo "We Don't allow those types of characters";
  
  }else{
   
    $query = mysqli_query($mysqli,"SELECT * FROM pages WHERE page_title = '$page_title' LIMIT 1");
    
    $row = mysqli_fetch_array($query);
    
    $title = $row['page_title'];
    $content = $row['page_content'];

    echo $content;

  }

}else{
  $query = mysqli_query($mysqli,"SELECT * FROM pages WHERE page_order = 1");
  
  $row = mysqli_fetch_array($query);
  
  $title = $row['page_title'];
  $content = $row['page_content'];

  echo $content;
}

?>

<?php include("footer.php"); ?>