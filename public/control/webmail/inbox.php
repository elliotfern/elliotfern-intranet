<?php
# conectare la base de datos
$activePage = "webmail";

echo '<div class="container">';
echo '<h2>Webmail</h2>';

?>
        <?php
            /* gmail connection,with port number 993 */
            $host = "{localhost:993/imap/ssl/novalidate-cert}INBOX";
            
            /* Your gmail credentials */
            $user = 'elliot@hispantic.com';
            $password = 'Saturn1213!*@';
  
            /* Establish a IMAP connection */
            $conn = imap_open($host, $user, $password) 
                 or die('unable to connect: ' . imap_last_error());
  
            /* Search emails from gmail inbox*/
            $mails = imap_search($conn, 'ALL');
  
            /* loop through each email id mails are available. */
            if ($mails) {
  
                /* Mail output variable starts*/
                $mailOutput = '';
                $mailOutput.= "<div class='".TABLE_DIV_CLASS."'>
                <table class='".TABLE_CLASS."'>
                <thead class='".TABLE_THREAD."'>
                <th>Subject</th>
                <th>From </th> 
                <th>Date Time</th>
                <th>Content</th>
                </tr></thead>";
  
                /* rsort is used to display the latest emails on top */
                rsort($mails);
  
                /* For each email */
                foreach ($mails as $email_number) {
                    /* Retrieve specific email information*/
                    $headers = imap_fetch_overview($conn, $email_number, 0);
  
                    /*  Returns a particular section of the body*/
                    $message = imap_fetchbody($conn, $email_number, '1');
                    $subMessage = substr($message, 0, 150);
                    $finalMessage = trim(quoted_printable_decode($subMessage));
  
                    $mailOutput.= '
                    <tbody>
                    <tr>';
  
                    /* Gmail MAILS header information */                   
                    $mailOutput.= '<td>' .
                                $headers[0]->subject . '</td> ';
                    $mailOutput.= '<td>' . 
                                $headers[0]->from . '</td>';
                    $mailOutput.= '<td>' .
                                 $headers[0]->date . '</td>';
  
                    /* Mail body is returned */
                    $mailOutput.= '<td>' . 
                    $finalMessage . '</td></tr></tbody>';
                }// End foreach
                $mailOutput.= '</table></div>';
                echo $mailOutput;
            }//endif 
            
            /* imap connection is closed */
            imap_close($conn);
            ?>

<?php

//include_once('modals-accounting.php');

# footer
include_once(APP_ROOT. '/inc/footer.php');

