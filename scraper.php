<?php
date_default_timezone_set("America/Los_Angeles");

$building = $_REQUEST['building'];
$building = str_replace(" ", "", $building);
$dw = date( "l" ); // Sunday through Saturday
$hr = date( "g" ); // 12-hour format, 1 through 12
$time = $_REQUEST['time'];

if ($dw == "Sunday") {
	$weekday = "Su";
} elseif ($dw == "Monday") {
	$weekday = ["M", "MW", "MWF", "MTuWTh", "MTWTF"];
} elseif ($dw == "Tuesday") {
	$weekday = ["Tu", "TuTh", "MTWTF", "MTuWTh"];
} elseif ($dw == "Wednesday") {
	$weekday = ["MW", "MWF", "MTuWTh", "MTWTF"];
} elseif ($dw == "Thursday") {
	$weekday = ["Th", "TuTh", "MTWTF", "MTuWTh"];
} elseif ($dw == "Friday") {
	$weekday = ["F", "MWF", "MTWTF"];
} elseif ($dw == "Saturday") {
	$weekday = "Sa";
}

if ($hr == 1) {
	$time = ["12-1", "1-2", "1130-1", "12-130", "1230-2", "1-230"];
} elseif ($hr == 2) {
	$time = ["1-2", "2-3", "1230-2", "1-230", "130-3", "2-330"];
} elseif ($hr <= 11) {
	$time = [(string) ($hr-1) . "-" . (string) $hr, (string) $hr . "-" . (string) ($hr+1), (string) ($hr-2) . "30-" . (string) $hr,
	(string) ($hr-1) . "-" . (string) $hr . "30", (string) ($hr-1) . "30-" . (string) ($hr+1), (string) $hr . "-" . (string) ($hr+1) . "30"];
} elseif ($hr == 12) {
	$time = ["11-12", "12-1", "1030-12", "11-1230", "1130-1", "12-130"];
}

foreach ( $weekday as $day) {
	foreach ($time as $classtime ) {
		$contents.= file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$day."&p_bldg=".$building."&p_hour="."$classtime");
	}
}

preg_match_all('/CLASS="coursetitle"><B>(.*?)</s', $contents, $titles);

preg_match_all('/Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</s', $contents, $timespaces);

foreach( $titles[1] as $index => $title ) {
   echo $title . " | " . $timespaces[1][$index], '<br>';
}

// foreach( $weekday as $day ) {
// 	foreach ( $time as $classtime ) {
// 		$contents.= file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$day."&p_bldg=".$building."&p_hour="."$classtime");
// 	}
// }

// preg_match_all('/CLASS="coursetitle"><B>(.*?)</s', $contents, $titles);

// preg_match_all('/Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</s', $contents, $timespaces);

// foreach( $titles[1] as $index => $title ) {
//    echo $hr+1 . " ". $title . "on " . $timespaces[1][$index], '<br>';
// }

// foreach( $weekday as $day ) {
// 	foreach ( $time as $classtime ) {
// 		// $contents.= file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$day."&p_bldg=".$building."&p_hour="."$classtime");
// 		echo $day . " " . $classtime;
// 	}
// }

// preg_match_all("/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x",
                // "Call 555-1212 or 1-800-555-1212", $phones);

// foreach($phones[0] as $phone) {
//     echo $phone, '<br>';
// }

// $city = $_GET['city'];
// $city = str_replace(" ", "", $city);

// $contents = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");

// preg_match('/3 Day Weather Forecast Summary:<\/b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.*?)</s', $contents, $matches);

// echo $matches[1];

?>