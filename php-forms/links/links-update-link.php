<?php
    $id = $params['id'];
?>
<div class="container">
<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/topics">Topics </a></h6>
</div>

  <div class="container form">
    <h2>Update link</h2>
    <h5 id="titolLinkUpdate"></h5>

  <div class="alert alert-success" id="updateLinkMessageOk" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ADD_OK_MESSAGE;?></h6>
  </div>
      
  <div class="alert alert-danger" id="updateLinkMessageErr" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ERROR_TYPE_MESSAGE; ?></h6>
  </div>

    <form method="POST" action="" id="modalFormUpdateLink" class="row g-3">
    <input type="hidden" id="id" name="id" value="">

    <div class="col-md-4">
    <label>Name link:</label>
    <input class="form-control" type="text" name="nom" id="nom" value="">
    </div>

    <div class="col-md-4">
    <label>URL link:</label>
    <input class="form-control" type="text" name="web" id="web" value="">
    </div>

    <div class="col-md-4">
    <label>Link topic:</label>
    <select class="form-select" name="cat" id="catTopicsLinks">
    <!-- Opciones se llenarán aquí -->
  </select>
    </div>

    <div class="col-md-4">
    <label>Language:</label>
    <select class="form-select" name="lang" id="lang">
        <option disabled>Select an option:</option>
        <option value="1">English</option>
        <option value="2">Catalan</option>
        <option value="3">Spanish</option>
        <option value="4">Italian</option>
        <option value="0">None</option>
    </select>
</div>

    <div class="col-md-4">
    <label>Type link:</label>
    <select class="form-select" name="tipus" id="tipusLinks">
    <option disabled>Select an option:</option>
    </select>
    </div>

    <hr/>

    <div class="container">
    <div class="row">
      <div class="col-6 text-left">
      <a href="#" onclick="window.history.back()" class="btn btn-secondary">Go back</a>
      </div>
      <div class="col-6 text-right derecha">
      <button type="submit" onclick="btnUpdateLink(event)" class="btn btn-primary">Update link</button>
      </div>
    </div>
  </div>


</form>
</div>

<script>
    formUpdateLink('<?php echo $id; ?>');
</script>

<?php
# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');