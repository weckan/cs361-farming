<?php

error_reporting(0); #(E_ALL);
ini_set('display_errors', 'Off');

function myPrintError ($parm,$errno) {
	echo '<div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4>Error!</h4>
          <p>Sorry there was a server problem. Try again later. ('.$parm.'-'.$errno.')</p></div>';
	die();
}

echo "      <table>\n";
$row = 1;
if (($handle = fopen("local.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$num = count($data);
		$row++;
		echo "        <tr>\n";
		for ($c=0; $c < $num; $c++) {
			echo "          <td>".$data[$c] . "</td>\n";
		}
		echo "        </tr>\n";
    }
	fclose($handle);
}
echo "      </table>\n";

?>
