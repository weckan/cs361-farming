<?php
//Turn on error reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <body>
    <h1>Light Control for each Plant</h1>
    <h2>First Quarter 2016 Schedule</h2>
    <div>
<?php
$row = 1;
if (($handle = fopen("local.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$num = count($data);
		$sun[$row] = array( "$data[0]", "$data[4]", "$data[5]", "$data[6]", "$data[7]" );
		$row++;
    }
	fclose($handle);
}
echo "    <h3>Lighting</h3>\n";
echo "      <table>\n";
for ($row=2; $row <= count($sun); $row++ ) {
	$h = 8;
	$m = 0;
	$s = 0;
	$M = 1;
	$D = 1;
	$Y = 2016;
	$now = mktime($h,$m,$s,$M,$D,$Y);
	$q1 = mktime(23,59,59,3,31,2016);
	$xDay = $sun[$row][3];
    $xWeek = $sun[$row][4];
	$hours = floor( 24 / $xDay);
	$days = floor( 7 / $xWeek);
	echo "<tr>\n";
	echo "<td>Plant&nbsp&nbsp&nbsp</td>\n";
	echo "<td>Date/Time&nbsp&nbsp&nbsp</td>\n";
	echo "<td>Level&nbsp&nbsp&nbsp</td>\n";
	echo "<td>Duration&nbsp&nbsp&nbsp</td>\n";
	echo "</tr>\n";
    while ( $now < $q1 ) {
		while ( $xWeek > 0 ) {
			while ( $xDay > 0 ) {
				if ( $now > $q1 ) { break; }
				echo "<tr>\n";
				echo "<td>". $sun[$row][0]. "&nbsp&nbsp&nbsp</td>\n";
				echo "<td>".date("Y-m-d H:i:s",$now)."&nbsp&nbsp&nbsp</td>\n";
				echo "<td>". $sun[$row][1]. "&nbsp&nbsp&nbsp</td>\n";
				echo "<td>". $sun[$row][2]. "&nbsp&nbsp&nbsp</td>\n";
				echo "</tr>\n";
				$h = $h + $hours;
				$now = mktime($h,$m,$s,$M,$D,$Y);
				$xDay--;
			}
			$xDay = $sun[$row][3];
			$D = $D + $days;
			$now = mktime($h,$m,$s,$M,$D,$Y);
			$xWeek--;
		}
		$xWeek = $sun[$row][4];
	}
	echo "<tr><td><br></td></tr>\n";
}
echo "      </table>\n";
?>
    </div>
  </body>
</html>
