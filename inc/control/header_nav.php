<?php

$submitPage = "";
$messageRequired = "";
$activePage = "";

if ($submitPage === TRUE) {
	$messageRequired = "Required";
}

$activePageAccount = $activePageHispanticWeb = $activePageElliotfernWeb = $activePageOpenHistory = $activePageContacts = $activePageHistory = $activePageImages = $activePageTravels = $activePageLibrary = $activePageLinks = $activePageCinema = $activePageMusic = $activePageVault = $activePageProgramming = $activePageProjects = $activePageContactForm = $activePageAccountElliotFernandez = $activePageUsers = "";

if ($activePage == "history") {
	$activePageHistory = "active";
} elseif ($activePage == "hispantic") {
	$activePageHispanticWeb = "active";
} elseif ($activePage == "library") {
	$activePageLibrary = "active";
} elseif ($activePage == "images") {
	$activePageImages = "active";
}  elseif ($activePage == "travel") {
	$activePageTravels = "active";
} elseif ($activePage == "links") {
	$activePageLinks = "active";
} elseif ($activePage == "openhistory") {
	$activePageOpenHistory = "active";
} elseif ($activePage == "accounting-hispantic") {
	$activePageAccount = "active";
} elseif ($activePage == "accounting") {
	$activePageAccountElliotFernandez = "active";
} elseif ($activePage == "cinema") {
	$activePageCinema = "active";
} elseif ($activePage == "contacts") {
	$activePageContacts = "active";
} elseif ($activePage == "music") {
	$activePageMusic = "active";
} elseif ($activePage == "vault") {
	$activePageVault = "active";
} elseif ($activePage == "programming") {
	$activePageProgramming = "active";
} elseif ($activePage == "projects") {
	$activePageProjects = "active";
} elseif ($activePage == "elliotfern") {
	$activePageElliotfernWeb = "active";
} elseif ($activePage == "contactform") {
	$activePageContactForm = "active";
} elseif ($activePage == "users") {
	$activePageUsers = "active";
} else {
	$activePage = "";
}

echo '
	<div class="text-end">';


	$loggedInUser = ($_SESSION['user']['id']);
	$url = APP_SERVER . "/controller/control/route.php?type=user&id=" . $loggedInUser;
	//call api
	$input = file_get_contents($url);
	$arr = json_decode($input, true);
	$obj = $arr[0];
	
	$welcome = 'Welcome, '.$obj['firstName']. ' '.$obj['lastName'].'';
	echo ''.$welcome.'';
	echo ' | <a href="'.APP_SERVER.'/logout">(Logout)</a>
	</div>

	<div class="container-fluid text-center" style="padding-top:20px;padding-bottom:25px">
		<a href="'.APP_SERVER.'/admin"><img src="'.APP_SERVER.'/inc/control/img/logo.png" alt="HispanTIC" width="300" height="64"></a>
	</div>

	<div class="container-fluid text-center" style="padding-top:20px;padding-bottom:25px">
		<h1 class="text-center"><a href="'.APP_SERVER.'/admin">Intranet</a></h1>
	</div>
	
	<div class="container-fluid text-center">
		<nav class="navbar navbar-expand-lg bg-body-tertiary text-center" data-bs-theme="dark" style="display:block;margin-top:10px;margin-bottom:35px">
			<button class="navbar-toggler text-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon text-center"></span>
			</button>
		<div class="collapse navbar-collapse justify-content-center menuHeader" id="navbarTogglerDemo01">
		<ul class="navbar-nav text-center">
				<li class="nav-item">
					<a class="nav-link '.$activePageAccount.'" id="accounting" href="'.APP_SERVER.'/control/accounting-hispantic">HispanTIC ERP & CRM</a>
				</li>

				<li class="nav-item">
					<a class="nav-link '.$activePageAccountElliotFernandez.'" id="accounting" href="'.APP_SERVER.'/control/accounting">SoleTrade ERP & CRM</a>
				</li>

				<li class="nav-item">
					<a class="nav-link '.$activePageProjects.'" href="'.APP_SERVER.'/control/projects">Projects</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageOpenHistory.'" href="'.APP_SERVER.'/control/history-web">OpenHistory web</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageElliotfernWeb.'" href="'.APP_SERVER.'/control/elliotfern-web">Elliotfern.com</a>
				</li>		
				<li class="nav-item">
					<a class="nav-link '.$activePageHistory.'" href="'.APP_SERVER.'/control/history">History</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageContacts.'" href="'.APP_SERVER.'/control/contacts">Contacts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageLibrary.'" href="'.APP_SERVER.'/control/library">Library</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageImages.'" href="'.APP_SERVER.'/control/images">Images</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageTravels.'" href="'.APP_SERVER.'/control/travels">Travels</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageLinks.'" href="'.APP_SERVER.'/control/links/">Links</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageCinema.'" href="'.APP_SERVER.'/control/cinema">Cinema</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageMusic.'" href="'.APP_SERVER.'/control/music">Music</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageVault.'" href="'.APP_SERVER.'/control/vault/">Vault</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageProgramming.'" href="'.APP_SERVER.'/control/programming/">Programming</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activePageContactForm.'" href="'.APP_SERVER.'/control/contact-form">Contact form</a>
				</li>
			</ul>
		</nav>
	</div>';