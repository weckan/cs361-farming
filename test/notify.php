<?php
//Turn on error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <body>
    <h1>Notification System</h1>
    <div>
<?php
    $to = "ratlifri@oregonstate.edu";
    $subject = "Farm Alert";
    $txt = "<p>Hello,</p>";
    $txt = "<p>This is an alert from your Home Farm Management system.</p>";
    $txt .= "<p>There is a problem with the water levels in your system. Please check your equipment at your earliest convenience.</p>";
    $txt = wordwrap($txt,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: notifications@farming.com\n";

    /* echo "<p>email sent to: $to</p>"; */
    echo "<p>subject: $subject</p>";
    echo "$txt";

    mail($to,$subject,$txt,$headers);

?>
    </div>
  </body>
</html>
