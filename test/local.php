<?php
//Turn on error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <body>
    <h1>Local Instructions for each Plant</h1>
    <div>
<?php
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
    </div>
  </body>
</html>
