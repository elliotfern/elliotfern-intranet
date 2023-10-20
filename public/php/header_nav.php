<?php

echo '
	<div class="text-end">';

// Genera o obtén tu clave secreta
$loggedInUser = ($_SESSION['user']['id']);
?>
<script type="module">
	import { nameUser } from "<?php echo APP_DEV; ?>/public/js/auth/auth.js";
	nameUser('<?php echo $loggedInUser; ?>')
</script>

<?php

	echo '<div id="userDiv"> </div>';
	echo ' | <a href="'.APP_DEV.'/logout">(Logout)</a>
	</div>

	<div class="container-fluid text-center" style="padding-top:20px;padding-bottom:25px">
		<a href="'.APP_DEV .'/admin"><img src="'. APP_DEV . '/public/img/logo.png" alt="HispanTIC" width="300" height="64"></a>
	</div>

	<div class="container-fluid text-center" style="padding-top:20px;padding-bottom:25px">
		<h1 class="text-center"><a href="'. APP_DEV .'/admin">Intranet</a></h1>
	</div>
	
	<div class="container-fluid text-center">
		<nav class="navbar navbar-expand-lg bg-body-tertiary text-center" data-bs-theme="dark" style="display:block;margin-top:10px;margin-bottom:35px">
			<button class="navbar-toggler text-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon text-center"></span>
			</button>
		<div class="collapse navbar-collapse justify-content-center menuHeader" id="navbarTogglerDemo01">
		<ul class="navbar-nav text-center">
				<li class="nav-item nav-link">
					<a id="accounting" href="'.APP_DEV.'/accounting-hispantic">HispanTIC ERP & CRM</a>
				</li>

				<li class="nav-item nav-link">
					<a id="accounting" href="'.APP_DEV.'/accounting">SoleTrade ERP & CRM</a>
				</li>

				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/projects">Projects</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/history-web">OpenHistory web</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/elliotfern-web">Elliotfern.com</a>
				</li>		
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/history">History</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/contacts">Contacts</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/library">Library</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/images">Images</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/travels">Travels</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/links/">Links</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/cinema">Cinema</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/music">Music</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/vault/">Vault</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/programming/">Programming</a>
				</li>
				<li class="nav-item nav-link">
					<a href="'.APP_DEV.'/contact-form">Contact form</a>
				</li>
			</ul>
		</nav>
	</div>';