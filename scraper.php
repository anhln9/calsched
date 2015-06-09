<?php

$building = $_REQUEST['building'];
$building = str_replace(" ", "", $building);

$weekday = $_REQUEST['weekday'];
$time = $_REQUEST['time'];

$contents = file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_day=".$weekday."&p_bldg=".$building."&p_hour="."$time");

preg_match_all('/CLASS="coursetitle"><B>(.*?)</s', $contents, $titles);

preg_match_all('/Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</s', $contents, $timespaces);

foreach( $titles[1] as $index => $title ) {
   echo $title . "on " . $timespaces[1][$index], '<br>';
}

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