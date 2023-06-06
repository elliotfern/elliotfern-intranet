<?php
$titolPB = "We release the contents to the Public Domain";
$PBurl = "https://creativecommons.org/publicdomain/zero/1.0/deed.en";
$textPB = "All the contents of this web page are published and sent to the public domain by renouncing all rights to the work in relation to intellectual property, including related rights, as far as it is possible with the applicable law applicable. You can copy, modify, distribute the work and make public communication, even for commercial purposes, without asking for any kind of permission.";
$textAbout = "Open History is an independent publishing project that offers readers free access history courses.";
$year = date("Y");
$webPath = APP_SERVER;

?>
<!-- Footer -->
<div class="container-amplada-total-footer">
    <div id="footer-elliotfern">
      <div class="menu-separacio">
        <a href="<?php echo APP_SERVER;?>">About me</a>
      </div>

      <div class="menu-separacio">
        <a href="<?php echo APP_SERVER; ?>">Privacy policy</a>
      </div>

      <div class="menu-separacio">
        <a href="<?php echo APP_SERVER; ?>">Contact</a>
      </div>
    </div>

      <hr>

      <div id="footer-elliotfern-petit">
            <a href="<?php echo $PBurl;?>" aria-label="Creative Commons" target='_blank' rel='noopener' title="Creative commons"><img class="mx-auto d-block" src="<?php echo $webPath ?>/img/elliotfern-icon/domini-public.gif" alt="Creative Commons" title='Public Domain' width='88' height='31'></a>
            
            <p><?php echo $textPB;?></p>
  
            <p>Elliot Fernandez (2002 - <?php echo $year;?>)</p>
    </div>

</div>
<!-- ./Footer -->

<link href="https://media.elliotfern.com/css/style.css" rel="stylesheet">
<script src="<?php echo APP_SERVER;?>/inc/matomo.js" async></script>
</body>
</html>

