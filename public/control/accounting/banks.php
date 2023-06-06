<?php
# conectare la base de datos
$activePage = "accounting";

echo '<div class="container">';
echo '<h1>Accounting - Sole trade</h1>';

?>

<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Payments and Banks</h3>
    <div class="row">
        <div class="col">
            <a href="https://dashboard.stripe.com/login" target="_blank"><img src="img/control/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>Stripe</h4></a>
        </div>

        <div class="col">
        <a href="https://www.paypal.com/signin" target="_blank"><img src="img/control/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>PayPal</h4></a>
        </div>

    </div>

    <div class="row" style="margin-top:100px">

        <div class="col">
            <a href="https://app.n26.com/login" target="_blank"><img src="img/control/bookmark.png" alt="Links" width="64" height="64" style="filter: invert(1);">
            <h4>N26</h4></a>
        </div>


        <div class="col">
            <a href="https://onlinebanking.aib.ie/inet/roi/login.htm" target="_blank"><img src="img/control/accounting.png" alt="Programming" width="64" height="64" style="filter: invert(1);">
            <h4>AIB</h4></a>
        </div>
        <div class="col">
        <a href="https://business.revolut.com/signin" target="_blank"><img src="img/control/tasks.png" alt="Vault" width="64" height="64" style="filter: invert(1);">
            <h4>Revolut</h4></a>
        </div>

    </div>

</div>

<?php
# footer
include_once(APP_ROOT. '/inc/control/footer.php');