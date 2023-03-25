<?php

include("functions.php");
include("../config.php");
include("check_login.php");
include("../get_settings.php");

if(isset($_POST['add_blog'])){
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"INSERT INTO blog SET blog_title = '$title', blog_url_title = '$url_title', blog_content = '$content', blog_by = $session_user_id");

	header("Location: blogs.php");

}

if(isset($_POST['edit_blog'])){
	$blog_id = intval($_POST['blog_id']);
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"UPDATE blog SET blog_title = '$title', blog_url_title = '$url_title', blog_content = '$content' WHERE blog_id = $blog_id");

	$_SESSION['response'] = "Blog updated.";

	header("Location: edit_blog.php?blog_id=$blog_id");

}

if(isset($_GET['delete_blog'])){
	$blog_id = intval($_GET['delete_blog']);

	mysqli_query($mysqli,"DELETE FROM blog WHERE blog_id = $blog_id");

	header("Location: blogs.php");

}

if(isset($_POST['add_doc'])){
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$category_id = intval($_POST['category']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"INSERT INTO docs SET doc_url_title = '$url_title', doc_title = '$title', doc_content = '$content', doc_created_by = $session_user_id, doc_category_id = $category_id");

	header("Location: docs.php");

}

if(isset($_POST['edit_doc'])){
	$doc_id = intval($_POST['doc_id']);
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$category_id = intval($_POST['category']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"UPDATE docs SET doc_url_title = '$url_title', doc_title = '$title', doc_content = '$content', doc_updated_by = $session_user_id, doc_category_id = $category_id WHERE doc_id = $doc_id");

	$_SESSION['response'] = "Doc updated.";

	header("Location: edit_doc.php?doc_id=$doc_id");

}

if(isset($_GET['delete_doc'])){
	$doc_id = intval($_GET['delete_doc']);

	mysqli_query($mysqli,"DELETE FROM docs WHERE doc_id = $doc_id");

	header("Location: docs.php");

}

if(isset($_POST['add_page'])){
	$order = intval($_POST['order']);
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"INSERT INTO pages SET page_title = '$title', page_url_title = '$url_title', page_content = '$content', page_order = $order, page_created_by = $session_user_id, page_active = 1");

	header("Location: pages.php");

}

if(isset($_POST['edit_page'])){
	$page_id = intval($_POST['page_id']);
	$title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
	$content = mysqli_real_escape_string($mysqli,$_POST['content']);
	$url_title = SeoUrl($title);

	mysqli_query($mysqli,"UPDATE pages SET page_title = '$title', page_url_title = '$url_title', page_content = '$content' WHERE page_id = $page_id");

	$_SESSION['response'] = "Page updated.";

	header("Location: edit_page.php?page_id=$page_id");

}

if(isset($_GET['delete_page'])){
	$page_id = intval($_GET['delete_page']);

	mysqli_query($mysqli,"DELETE FROM pages WHERE page_id = $page_id");

	header("Location: pages.php");

}

if(isset($_POST['add_link'])){
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));
	$icon = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['icon'])));
	$url = trim(mysqli_real_escape_string($mysqli,$_POST['url']));
	$order = intval($_POST['order']);

	mysqli_query($mysqli,"INSERT INTO links SET link_name = '$name', link_icon = '$icon', link_url = '$url', link_order = $order");

	header("Location: links.php");

}

if(isset($_POST['edit_link'])){
	$link_id = intval($_POST['link_id']);
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));
	$icon = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['icon'])));
	$url = trim(mysqli_real_escape_string($mysqli,$_POST['url']));
	$order = intval($_POST['order']);

	mysqli_query($mysqli,"UPDATE links SET link_name = '$name', link_icon = '$icon', link_url = '$url', link_order = $order WHERE link_id = $link_id");

	$_SESSION['response'] = "Link updated.";

	header("Location: links.php");

}

if(isset($_GET['delete_link'])){
	$link_id = intval($_GET['delete_link']);

	mysqli_query($mysqli,"DELETE FROM links WHERE link_id = $link_id");

	header("Location: links.php");

}

if(isset($_POST['add_category'])){
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));

	mysqli_query($mysqli,"INSERT INTO categories SET category_name = '$name'") OR DIE("ERROR!");

	header("Location: categories.php");

}

if(isset($_POST['edit_category'])){
	$category_id = intval($_POST['category_id']);
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));

	mysqli_query($mysqli,"UPDATE categories SET category_name = '$name' WHERE category_id = $category_id");

	$_SESSION['response'] = "Category updated.";

	header("Location: categories.php");

}

if(isset($_GET['delete_category'])){
	$category_id = intval($_GET['delete_category']);

	mysqli_query($mysqli,"DELETE FROM categories WHERE category_id = $category_id");

	$_SESSION['response'] = "Category deleted.";

	header("Location: categories.php");

}

if(isset($_POST['add_file'])){

  if($_FILES['file']['tmp_name']!='') {
    $path = "../upload/";
    $path = $path . basename( $_FILES['file']['name']);
    $file_name = basename($path);
    move_uploaded_file($_FILES['file']['tmp_name'], $path);
  }

  mysqli_query($mysqli,"INSERT INTO files SET file_name = '$file_name'");
  
  header("Location: " . $_SERVER["HTTP_REFERER"]);

}

if(isset($_GET['delete_file'])){
    $file_id = intval($_GET['delete_file']);

    $sql_file = mysqli_query($mysqli,"SELECT * FROM files WHERE file_id = $file_id");
    $row = mysqli_fetch_array($sql_file);
    $file_name = $row['file_name'];

    unlink("/upload/$file_name");

    mysqli_query($mysqli,"DELETE FROM files WHERE file_id = $file_id");

    header("Location: " . $_SERVER["HTTP_REFERER"]);
  
}

if(isset($_POST['add_user'])){
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));
	$email = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['email'])));
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$access = intval($_POST['access']);

	mysqli_query($mysqli,"INSERT INTO users SET user_name = '$name', user_email = '$email', user_password = '$password', user_access = $access");

	$_SESSION['response'] = "User added.";

	header("Location: users.php");

}

if(isset($_POST['edit_user'])){
	$user_id = intval($_POST['user_id']);
	$name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['name'])));
	$email = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['email'])));
    $password = trim($_POST['password']);
	$access = intval($_POST['access']);

	mysqli_query($mysqli,"UPDATE users SET user_name = '$name', user_email = '$email', user_access = $access WHERE user_id = $user_id");

	if(!empty($password)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($mysqli,"UPDATE users SET user_password = '$password' WHERE user_id = $user_id");
  }

	header("Location: users.php");

}

if(isset($_GET['delete_user'])){
	$user_id = intval($_GET['delete_user']);

	mysqli_query($mysqli,"DELETE FROM users WHERE user_id = $user_id");

	header("Location: users.php");

}

if(isset($_GET['approve_user'])){
  $user_id = intval($_GET['approve_user']);

  mysqli_query($mysqli,"UPDATE users SET user_access = 1 WHERE user_id = $user_id");
  echo "<script>window.location = 'users.php'</script>";
}

if(isset($_POST['edit_settings'])){
	$site_name = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['site_name'])));
	$author = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['author'])));
	$description = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['description'])));
	$theme = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['theme'])));
	$date_time_format = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['date_time_format'])));
	$docs_enabled = intval($_POST['docs_enabled']);
	$forum_enabled = intval($_POST['forum_enabled']);
	$blog_enabled = intval($_POST['blog_enabled']);
	$user_registration_enabled = intval($_POST['user_registration_enabled']);

	mysqli_query($mysqli,"UPDATE settings SET config_site_name = '$site_name', config_meta_author = '$author', config_meta_description = '$description', config_theme = '$theme', config_date_time_format = '$date_time_format', config_module_docs_enabled = $docs_enabled, config_module_forum_enabled = $forum_enabled, config_module_blog_enabled = $blog_enabled, config_module_user_registration_enabled = $user_registration_enabled WHERE setting_id = 1");

	$_SESSION['response'] = "Settings updated.";

	header("Location: settings.php");

}

?>