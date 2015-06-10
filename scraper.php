<?php
date_default_timezone_set("America/Los_Angeles");

$building = $_REQUEST['building'];
$building = str_replace(" ", "", $building);
$dw = date( "l" ); // Sunday through Saturday
// $hr = date( "G" ); // 24-hour format, 0 through 23
$hr = 19;

if ($dw == "Sunday") {
	$weekday = "Su";
} elseif ($dw == "Monday") {
	$weekday = ["M", "MW", "MWF", "MTuWTh", "MTWTF"];
} elseif ($dw == "Tuesday") {
	$weekday = ["Tu", "TuTh", "MTWTF", "MTuWTh"];
} elseif ($dw == "Wednesday") {
	$weekday = ["W", "MW", "MWF", "MTuWTh", "MTWTF"];
} elseif ($dw == "Thursday") {
	$weekday = ["Th", "TuTh", "MTWTF", "MTuWTh"];
} elseif ($dw == "Friday") {
	$weekday = ["F", "MWF", "MTWTF"];
} elseif ($dw == "Saturday") {
	$weekday = "Sa";
}

if ($hr == 13) {
	$time = ["12-2", "12-3", "1-2", "1-3", "1-4", "1130-1", "12-130", "1230-2", "1-230"];
} elseif ($hr == 14) {
	$time = ["1-3", "1-4", "2-3", "2-4", "2-5", "1230-2", "1-230", "130-3", "2-330"];
} elseif ($hr <= 11 && $hr >= 7) {
	$h = $hr;
	$time = [(string) ($h-1) . "-" . (string) ($h+1), (string) $h . "-" . (string) ($h+1), (string) $h . "-" . (string) ($h+2), (string) $h . "-" . (string) ($h+3), (string) ($h-2) . "30-" . (string) $h,
	(string) ($h-1) . "-" . (string) $h . "30", (string) ($h-1) . "30-" . (string) ($h+1), (string) $h . "-" . (string) ($h+1) . "30"];
} elseif ($hr >= 15 && $hr <= 19) {
	$h = $hr-12;
	$time = [(string) ($h-1) . "-" . (string) ($h+1), (string) $h . "-" . (string) ($h+1), (string) $h . "-" . (string) ($h+2), (string) $h . "-" . (string) ($h+3), (string) ($h-2) . "30-" . (string) $h,
	(string) ($h-1) . "-" . (string) $h . "30", (string) ($h-1) . "30-" . (string) ($h+1), (string) $h . "-" . (string) ($h+1) . "30"];
} elseif ($hr == 12) {
	$time = ["12-1", "12-2", "12-3", "11-1230", "1130-1", "12-130"];
}

foreach ( $weekday as $day) {
	foreach ( $time as $classtime ) {
		$contents.= file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$day."&p_bldg=".$building."&p_hour=".$classtime);
	}
}

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