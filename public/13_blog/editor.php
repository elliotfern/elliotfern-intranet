<?php
# conectare la base de datos
$activePage = "blog";

$slug = $params['slug'];

$url = APP_SERVER . "/controller/blog.php?type=blog&slug=" . $slug;


//call api
$input = file_get_contents($url);
$arr = json_decode($input, true);
$obj = $arr[0];
?>


<script src="https://cdn.tiny.cloud/1/buhmn5deo2zhds5dkrpxmne2bh55ev79m4h0pnmps5knc6b0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#tiny'
            plugins: [
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help'
      })
    </script>

<div class="container">
<h2>Blog</h2>
<h3><?php echo $obj['post_title']; ?></h3>

<!-- Create the editor container -->

<form>
 <textarea id="tiny"></textarea>
<?php echo $obj['post_content']; ?>
</textarea>
</form>



</div>

<?php
//include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');