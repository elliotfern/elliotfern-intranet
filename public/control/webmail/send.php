<?php
# conectare la base de datos
$activePage = "webmail";

echo '<div class="container">';
echo '<h2>Webmail</h2>';

        echo '<form method="POST" action="" id="send" class="row g-3">';

        echo '<input type="hidden" id="from" name="from" value="elliot@hispantic.com">';

        echo '<div class="col-md-6">';
        echo '<label>To:</label>';
        echo '<input class="form-control" type="text" name="to" id="to">';
        echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
        echo '</div>';

        echo '<div class="col-md-6">';
        echo '<label>Subject:</label>';
        echo '<input class="form-control" type="text" name="subject" id="subject">';
        echo '<label style="color:#dc3545;display:none" id="subject">* Invalid data</label>';
        echo '</div>';

        echo '<div class="col-md-12">';
        echo '<label>Message</label>';
        echo '<textarea class="form-control" name="message" id="message"rows="15"></textarea>';
        echo '</div>';

            echo '<div class="col-12">';
        echo '<button type="submit" name="send" id="btnUpdateLink" class="btn btn-primary">Send email</button>';
        echo '</div>';

        echo "</form>";

    if(isset($_POST['send'])) {
        function data_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        
          // insert data to db
          if (empty($_POST["to"])) {
            $hasError=true;
          } else {
            $to = data_input($_POST['to'], ENT_COMPAT);
          }
        
          if (empty($_POST["subject"])) {
            $hasError=true;
          } else {
            $subject = data_input($_POST['subject'], ENT_COMPAT);
          }
        
          if (empty($_POST["message"])) {
            $hasError=true;
          } else {
            $message2 = data_input($_POST['message'], ENT_COMPAT);
          }
                  
        if (!isset($hasError)) {
            $message = "";
            $message .= $message2;
            $message .= "<br><br><hr><img src='https://hispantic.com/hispantic_logo_firma.jpg' alt='HispanTIC' style='height: 80px;width:200px'>
            <p style='font-weight:bold'>Elliot Fernandez</p>
            <p>Front-End Developer</p>
            <p><a href='https://hispantic.com/'>HispanTIC.com</a></p>
            <p style='font-weight:bold'>E-mail: <a href='mailto:elliot@hispantic.com'>elliot@hispantic.com</a></p>
            <p style='font-weight:bold'>Phone number: <a href='tel:+3530894882938'>(+353) 089 488 2938</a></p>
            <p><small>Legal notice: In compliance with EU General Data Protection Regulation (GDPR) we inform you that your personal data of contact have been incorporated into a computerized file owned by Hispano Atlantic Consulting Ltd, who will be the sole recipient of the data, and the purpose is the management of customer data and commercial information. We also inform you that you have the possibility of exercising the rights of access, rectification, cancellation and opposition set forth in the Law; via email addressed to Hispano Atlantic Consulting Ltd -Ref. Data Protection, at the address: info@hispantic.com</small></p>";

            $header = "From:elliot@hispantic.com \r\n";
            // $header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            
            $retval = mail ($to,$subject,$message,$header);
            
            if( $retval == true ) {
                echo "Message sent successfully...";
            }else {
                echo "Message could not be sent...";
            }
        } else {
            echo "Error";
        }
    }
      ?>
      
   </body>
</html>
<?php

//include_once('modals-accounting.php');

# footer
include_once(APP_ROOT. '/inc/footer.php');

