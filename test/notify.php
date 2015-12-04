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
    $txt .= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
    $txt = wordwrap($txt,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: notifications@farming.com\n";

    echo "<p>email sent to: $to</p>";
    echo "<p>subject: $subject</p>";
    echo "$txt";

    mail($to,$subject,$txt,$headers);

?>
    </div>
  </body>
</html>
