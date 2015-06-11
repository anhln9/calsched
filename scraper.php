<?php
date_default_timezone_set("America/Los_Angeles");

$building = $_REQUEST['building'];
$building = str_replace(" ", "", $building);

if (!isset($_REQUEST['dw'])) {
	$dw = date( "l" ); // Sunday through Saturday
} else {
	$dw = $_REQUEST['dw'];
}
if (!isset($_REQUEST['hr'])) {
	$hr = date( "G" ); // 24-hour format, 0 through 23
} else {
	$hr = $_REQUEST['hr'];
}

$dw = strtolower($dw);

if (in_array($dw, array("sunday", "su", "sun"))) {
	$weekday = "su";
} elseif (in_array($dw, array("monday", "m", "mo", "mon"))) {
	$weekday = "m";
} elseif (in_array($dw, array("tuesday", "t", "tu", "tues"))) {
	$weekday = "Tu";
} elseif (in_array($dw, array("wednesday", "w", "wed"))) {
	$weekday = "W";
} elseif (in_array($dw, array("thursday", "th", "thu", "thurs"))) {
	$weekday = "Th";
} elseif (in_array($dw, array("friday", "f", "fr", "fri"))) {
	$weekday = "F";
} elseif (in_array($dw, array("saturday", "s", "sa", "sat"))) {
	$weekday = "Sa";
} elseif ($dw != '') { // avoids people playing with irrelevant inputs
	$weekday = "none";
}

if ($hr > 12 && $hr < 20) {
	$classtime = $hr - 12;
} elseif ($hr < 12 || $hr >= 20) {
	$classtime = $hr;
}

$contents = file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$weekday."&p_bldg=".$building."&p_hour=".$classtime);

preg_match_all('/CLASS="coursetitle"><B>(.*?)&nbsp;<INPUT TYPE="submit" VALUE="\(catalog description\)" class="button b buttonrender"><\/B><\/TD><\/TR><\/FORM><TR><TD ALIGN=RIGHT VALIGN=TOP NOWRAP>
           <FONT FACE="Helvetica, Arial, sans-serif" SIZE="1"><B>Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</m', $contents, $titles);

foreach ($titles[1] as $index => $title) {
	echo $title . " | " . $titles[2][$index], '<br>';
}

?>