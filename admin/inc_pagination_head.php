<?php
/*
 * Pagination - Head
 * Sets the paging/sort for use in limit/order by
 * Sets the default search query from GET to $q
 *
 * Should not be accessed directly, but called from other pages
 */

// Paging
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $record_from = (($page)-1)*$_SESSION['records_per_page'];
    $record_to = $_SESSION['records_per_page'];
} else {
    $record_from = 0;
    $record_to = $_SESSION['records_per_page'];
    $page = 1;
}

// Order
if(isset($_GET['order'])){
    if($_GET['order'] == 'ASC'){
        $order = "DESC";
    }else{
        $order = "ASC";
    }
}else{
    $order = "DESC";
}

// Search
if (isset($_GET['search'])) {
    $search = sanitizeInput($_GET['search']);
} else {
    $search = "";
}

// Sortby
if (!empty($_GET['sortby'])) {
    $sortby = sanitizeInput($_GET['sortby']);
}