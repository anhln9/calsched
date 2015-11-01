<?php
// Re-generate JSON for Berkeley schedule

$building_contents = json_decode(file_get_contents("buildings.json"), true);
foreach ($building_contents as $building_index => $building) {
  $building_abbr = $building_contents[$building_index]['Abbr'];

  $schedule_api = file_get_contents("http://osoc.berkeley.edu/OSOC/osoc?p_term=FL&p_bldg=".$building_abbr);
  preg_match_all('/CLASS="coursetitle"><B>(.*?)&nbsp;<input type="submit" value="\(catalog description\)" class="button b buttonrender" \/><\/B><\/TD><\/TR><\/form><TR><TD ALIGN=RIGHT VALIGN=TOP NOWRAP>
           <FONT FACE="Helvetica, Arial, sans-serif" SIZE="1"><B>Location:&#160;<\/B><\/FONT><\/TD><TD NOWRAP><TT>(.*?)</m', $schedule_api, $titles);
  // $courses[$building_index]['building'] = $building_abbr;
  foreach ($titles[1] as $index => $title) {
    $courses[$index][$building_abbr]['name'] = $title;
    $courses[$index][$building_abbr]['location'] = $titles[2][$index];
  }
}

$fp = fopen('osoc-berkeley-schedule.json', 'w');
fwrite($fp, json_encode($courses));
fclose($fp);