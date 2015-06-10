<?php
date_default_timezone_set("America/Los_Angeles");

$building = $_REQUEST['building'];
$building = str_replace(" ", "", $building);
$dw = date( "l" ); // Sunday through Saturday
$hr = date( "G" ); // 24-hour format, 0 through 23

if ($dw == "Sunday") {
	$weekday = "Su";
} elseif ($dw == "Monday") {
	$weekday = "M";
} elseif ($dw == "Tuesday") {
	$weekday = "Tu";
} elseif ($dw == "Wednesday") {
	$weekday = "W";
} elseif ($dw == "Thursday") {
	$weekday = "Th";
} elseif ($dw == "Friday") {
	$weekday = "F";
} elseif ($dw == "Saturday") {
	$weekday = "Sa";
}

if ($hr > 12) {
	$classtime = $hr - 12;
} elseif ($hr < 12) {
	$classtime = $hr;
}

$contents = file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$weekday."&p_bldg=".$building."&p_hour=".$classtime);

preg_match_all('/CLASS="coursetitle"><B>(.*?)&nbsp;<INPUT TYPE="submit" VALUE="\(catalog description\)" class="button b buttonrender"><\/B><\/TD><\/TR><\/FORM><TR><TD ALIGN=RIGHT VALIGN=TOP NOWRAP>
           <FONT FACE="Helvetica, Arial, sans-serif" SIZE="1"><B>Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</m', $contents, $titles);

foreach ($titles[1] as $index => $title) {
	echo $title . " | " . $titles[2][$index], '<br>';
}

// $str = '<a href="http://google.com">Google</a>';
// if (preg_match('#<a href="(.*?)">(.*?)</a>#', $str, $matches)) {
//     var_dump($matches);
// }

// preg_match_all('/CLASS="coursetitle"><B>(.*?)</s', $contents, $titles);

// preg_match_all('/Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</s', $contents, $timespaces);

// foreach( $titles as $index => $title ) {
//    echo $title . " | " . $timespaces[1][$index], '<br>';
// }

// preg_match_all("/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x",
                // "Call 555-1212 or 1-800-555-1212", $phones);

// foreach($phones[0] as $phone) {
//     echo $phone, '<br>';
// }

?>