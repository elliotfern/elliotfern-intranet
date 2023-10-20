<?php
# conectare la base de datos
$activePage = "blog";

$slug = $params['slug'];
global $conn;

$url = APP_SERVER . "/controller/blog.php?type=blog&slug=" . $slug;

//call api
$input = file_get_contents($url);
$arr = json_decode($input, true);
$obj = $arr[0];

?>

<div class="container">
<h2>Blog</h2>
<h3><?php echo $obj['post_title'] ?></h3>

<?php
echo "<div> " . $obj['post_content'] ."";
echo "</div>";
?>
</div>

<?php
//include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');