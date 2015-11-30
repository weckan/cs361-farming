<?php
//Turn on error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <body>
    <h1>Dispense Care for each Plant</h1>
    <h2>First Quarter 2016 Schedule</h2>
    <div>
<?php
$row = 1;
if (($handle = fopen("local.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$num = count($data);
		$water[$row] = array( "$data[0]", "$data[1]", "$data[2]", "$data[3]" );
		$row++;
    }
	fclose($handle);
}
echo "    <h3>Water</h3>\n";
echo "      <table>\n";
for ($row=2; $row <= count($water); $row++ ) {
	$h = 0;
	$m = 0;
	$s = 0;
	$M = 1;
	$D = 1;
	$Y = 2016;
	$now = mktime($h,$m,$s,$M,$D,$Y);
	$q1 = mktime(0,0,0,3,31,2016);
	$xDay = $water[$row][2];
    $xWeek = $water[$row][3];
	if ( $xDay > 0 ) { $hours = floor(24 / $xDay); } else { $hours = 1; }
	if ( $xWeek > 0 ) { $days = floor( 7 / $xWeek); } else { $days = 1; }
    while ( $now < $q1 ) {
		while ( $xWeek > 0 ) {
			while ( $xDay > 0 ) {
				echo "<tr>\n";
				echo "<td>". $water[$row][0]. "</td>\n";
				echo "<td>".date("Y-m-d H:i:s",$now)."</td>\n";
				echo "</tr>\n";
				if ( $hours < 24 ) { $h = $h + $hours; }
				$now = mktime($h,$m,$s,$M,$D,$Y);
				$xDay--;
			}
			$xDay = $water[$row][2];
			if ( $days < 7 ) { $D = $D + $days; }
			$now = mktime($h,$m,$s,$M,$D,$Y);
			$xWeek--;
		}
		$xWeek = $water[$row][3];
	}
}
echo "      </table>\n";
?>
    </div>
  </body>
</html>
