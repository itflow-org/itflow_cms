<?php 

$page_title = "Forum"; 
    
include("../config.php");
include("../header.php"); 
include("../check_login.php");

if($config_module_forum_enabled == 0){
    echo "404 Error (Module Not Enabled)";
    exit();
}

//Initialize the HTML Purifier to prevent XSS
require("../plugins/htmlpurifier/HTMLPurifier.standalone.php");
$purifier_config = HTMLPurifier_Config::createDefault();
$purifier_config->set('URI.AllowedSchemes', ['data' => true, 'src' => true, 'http' => true, 'https' => true]);
$purifier = new HTMLPurifier($purifier_config);

$sql = mysqli_query($mysqli,"SELECT * FROM posts, users WHERE user_id = post_by ORDER BY post_id DESC");

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
    <h2>Forum</h2>
    <?php if($_SESSION['logged']){ ?>
    <a href="new_topic.php" class="btn btn-outline-primary">New Topic</a>
    <?php } ?>
</div>

<div class="table-responsive">
    <table class="table table-hover">   
        <thead> 
            <tr>    
                <th>Topic</th>
                <th>Replies</th>
                <th>Last Post</th>
            </tr>
        </thead>
        <tbody>
            
        <?php

        while($row = mysqli_fetch_array($sql)){
            $post_id = intval($row['post_id']);
            $username = htmlentities($row['user_name']);
            $post_title = htmlentities($row['post_title']);
            $post_url_title = htmlentities($row['post_url_title']);
            $post_date = date($config_date_time_format, strtotime($row['post_date']));

            $sql_replies = mysqli_query($mysqli,"SELECT * FROM replies, users WHERE users.user_id = replies.reply_by AND post_id = $post_id ORDER BY reply_id DESC");
            $replies = mysqli_num_rows($sql_replies);
            $row = mysqli_fetch_array($sql_replies);
            $reply_id = intval($row['reply_id']);
            $reply_by = htmlentities($row['user_name']);
            $reply_body = $purifier->purify($row['reply_body']);
            $reply_date = date($config_date_time_format, strtotime($row['reply_date']));               
            ?>
            <tr>
                <td>
                    <strong><a href="post_details.php?topic=<?php echo $post_url_title; ?>"><?php echo $post_title; ?></a></strong>
                    <br>
                    <small class="text-secondary">by <?php echo $username; ?> <?php echo $post_date; ?></small>
                </td>
                <td><?php echo $replies; ?></td>
                <td>
                    <?php if($replies > 0){ ?>
                    by <?php echo $reply_by; ?>
                    <br>
                    <?php echo "<small>$reply_date</small>"; ?>
                    <?php }else{ echo "-"; } ?>
                </td>
            </tr>
        <?php
        }
        ?>
        
        </tbody>
    </table>
</div>

<?php include("../footer.php"); ?>