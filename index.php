<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Find classes in progress</title>
    <!-- App is deployed at https://calsched.herokuapp.com or http://runnyomelets.com-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWzWXTmQHUU3OHr2bKeRUn4dNE5PUtpxk"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    
    <script type="text/javascript">
    function initialize() {
        var mapDiv = document.getElementById('map-canvas');
        var map = new google.maps.Map(mapDiv, {
            center: new google.maps.LatLng(37.874, -122.258),
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        //store the original setContent-function
        var fx = google.maps.InfoWindow.prototype.setContent;
        //override the built-in setContent-method
        google.maps.InfoWindow.prototype.setContent = function (content) {
        //when argument is a node
            if (content.querySelector) {
            //search for the address
                var title = content.querySelector('.gm-title').textContent.split(" ");
                var addr = content.querySelector('.gm-basicinfo .gm-addr').textContent.split(" ");
                
                // when address doesn't have number
                if (isNaN(parseInt(addr))) {
                    // click on name + Hall: Hildebrand Hall, Davis Hall
                    // Bancroft Lib-South Hall Rd, LeConte Hall-South Hall Rd
                    // Hearst Memorial Mining Building
                    if (addr[0] === "Berkeley," || title[1] === "Hall" || title[1] === "Library" || title[2] === "Library") {
                        var buildingName = title[0].replace(/[^\w\s]/gi, '');
                    // special name: O'Brien Hall
                    } else {
                        var buildingName = addr[0].replace(/[^\w\s]/gi, '');
                    }
                    //leave the function here 
                    //when you don't want the InfoWindow to appear

                // when address has number
                } else {
                    // Marvell Nano Lab, 502 Sutardja Dai Hall
                    // College of Env Design, 230 Wurster Hall
                    if (addr[2].replace(/[^\w\s]/gi, '') === "Hall" || addr[3].replace(/[^\w\s]/gi, '') === "Hall" && title[1] != "Hall") {
                        var buildingName = addr[1].replace(/[^\w\s]/gi, '');
                    // Moffitt Undergrad Lib, 350 University Drive
                    } else {
                        var buildingName = title[0].replace(/[^\w\s]/gi, '');
                    }
                }
                $('#buildingRealtime').val(buildingName);
                $('#buildingPlan').val(buildingName);
            }
            //run the original setContent-method
            fx.apply(this, arguments);
        };
    }

    google.maps.event.addDomListener(window, 'load', initialize);

            // google.maps.event.addListener(rectangle, 'click', function(args) {
            //     var url = "https://maps.googleapis.com/maps/api/geocode/xml?latlng=" + args.latLng.lat() + "," + args.latLng.lng() + "&key=AIzaSyDWzWXTmQHUU3OHr2bKeRUn4dNE5PUtpxk";
            //     $.ajax({
            //         type: "GET",
            //         url: url,
            //         dataType: "xml",
            //         success: processXML,
            //         error: error
            //     });

            //     function error() {
            //         $("#fail").fadeIn();
            //     }

            //     function processXML(xml) {
            //         $(xml).find("address_component").each(function() {
            //             if ($(this).find("type").text() == "route") {
            //                 $('#buildingRealtime').val($(this).find("long_name").text());
            //             }
            //         });
            //     }
            // });
    </script>

    <style>

    .alert {
        display:none;
    }

    #description>a, a:hover {
        color:#000;
    }

    h5>a, a:hover {
        color:#000;
    }

    .center {
        text-align: center;
    }

    #map-canvas {
        width: 600px;
        height: 600px;
    }

    @media screen and (max-width:600px) {
        #map-canvas {
            width:270px;
            height:320px;
        }
    }

    @media screen and (min-width:601px) {
        #map-canvas {
            width:470px;
            height:520px;
        }
    }

    @media screen and (min-width:1200px) {
        #map-canvas {
            width:600px;
            height:600px;
        }
    }

    ul {
        list-style-type: none;
    }

    hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 2px solid #addff9;
        border-bottom: 2px solid #ffffff;
    }

    </style>

</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h5 class="black"><a href="http://runnyomelets.com"><span class="glyphicon glyphicon-arrow-left black" aria-hidden="true"></span>  Back</a></h4>

            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-5">

            <h3 id="description"><a href="/calsched">Real-time class finder, UC Berkeley campus</a></h3>

                <h4>Current: Fall 2015 Schedule</h4>

                <h4><?php date_default_timezone_set("America/Los_Angeles"); echo date("l"). ", "; ?>
                    <span id="hours"><?=date('H');?></span>:<span id="minutes"><?=date('i');?></span>:<span id="seconds"><?=date('s');?></span>
                </h4>

                <p>Click on a building name to start searching.</p>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#realtime">Real time</a></li>
                    <li><a data-toggle="tab" href="#plan">Plan</a></li>
                </ul>

                <div class="tab-content">
                    <div id="realtime" class="tab-pane fade in active">
                        <form>
                            <div class="form-group">
                                <input type="text" id="buildingRealtime" name="buildingRealtime" class="form-control" placeholder="Where: Leconte, Hearst, Evans, Tan,..."/>
                            </div>
                        </form>
                        <button id="findScheduleRealtime" class="btn btn-default btn-md center">Find Schedule</button>
                    </div>

                    <div id="plan" class="tab-pane fade in">
                        <form>
                            <div class="form-group">
                                <input type="text" id="buildingPlan" name="buildingPlan" class="form-control" placeholder="Where: Dwinelle, Stanley, Barrows, Soda,..."/>
                                <input type="text" id="dw" name="dw" class="form-control" placeholder="When: Monday, M, W, Tu, Th,..."/>
                                <input type="text" id="hr" name="hr" class="form-control" placeholder="More specific: 930, 2, 11-1230,..."/>
                            </div>
                        </form>
                        <button id="findSchedulePlan" class="btn btn-primary btn-md center">Find Schedule</button>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div id="success" class="alert alert-info"></div>
                    <div id="fail" class="alert alert-warning"></div>
                    <div id="noBuilding" class="alert alert-warning">That's not really a building name, check the list below!</div>
                </div>

            </div>

            <div class="col-md-5">
                <div id="map-canvas"></div>
            </div>
        </div>

        <hr>

                <script>
                var thetime = '13:14:15';
                // this would be something like: var thetime = '<?=date('H:i:s');?>';
                var arr_time = thetime.split(':');
                var ss = arr_time[2]; var mm = arr_time[1]; var hh = arr_time[0];
                var update_ss = setInterval(updatetime, 1000);

                function updatetime() {
                    ss++;
                    if (ss < 10) {
                        ss = '0' + ss;
                    }
                    if (ss == 60) {
                        ss = '00'; mm++;
                        if (mm < 10) {
                            mm = '0' + mm;
                        }
                        if (mm == 60) {
                            mm = '00'; hh++;
                            if (hh < 10) {
                                hh = '0' + hh;
                            }
                            if (hh == 24) {
                                hh = '00';
                            }
                            $("#hours").html(hh);
                        }
                        $("#minutes").html(mm);
                    }
                    $("#seconds").html(ss);
                }

                </script>

        <div id="listOfBuildings" class="row">

            <h3 class="center">List of buildings:</h3>

            <div class="col-md-4" id="buildingListAtoG"><h4 class="center">A-G</h4></span></div>

            <script type="text/javascript">
            $.getJSON( "buildingsAtoG.json", function( data ) {
                console.log(data);
                var items = [];
                $.each( data, function( key, row ) {
                    items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
                });

                $( "<ul/>", {
                    html: items.join( "" )
                }).appendTo( "#buildingListAtoG" );
            });
            </script>

            <div class="col-md-4" id="buildingListHtoM"><h4 class="center">H-M</h4></div>
            <script type="text/javascript">
            $.getJSON( "buildingsHtoM.json", function( data ) {
                console.log(data);
                var items = [];
                $.each( data, function( key, row ) {
                    items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
                });

                $( "<ul/>", {
                    html: items.join( "" )
                }).appendTo( "#buildingListHtoM" );
            });
            </script>

            <div class="col-md-4" id="buildingListNtoZ"><h4 class="center">N-Z</h4></div>
            <script type="text/javascript">
            $.getJSON( "buildingsNtoZ.json", function( data ) {
                console.log(data);
                var items = [];
                $.each( data, function( key, row ) {
                    items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
                });

                $( "<ul/>", {
                    html: items.join( "" )
                }).appendTo( "#buildingListNtoZ" );
            });
            </script>

        </div>

        <hr>

        <footer id="footer">
            <p class="center"><b>Source code <a href="https://github.com/anhln9/calsched">on Github</a></b></p>
        </footer>

        <hr>

    </div>

    <script>
    $(document).ready(function() {
        $("#listOfBuildings a").click(function() {
            var value = $(this).html();
            $('#buildingRealtime').val(value);
            $('#buildingPlan').val(value);
        });
    });

    var messages = ["How about we go and feed the birds?", "Andddd an apple a day keeps the doctor away.",
    "I'm off to see the wizards.", "But tomorrow is another day.", "Oh yeah, I need to sleep. Zzzzz.",
    "Want some BBQ chicken dipped in sweet and spicy sauce and ten cheese sticks on the side? Yum.", "Time for tea.", "No soup for you!",
    "Quiz time. What did Cafe 3 serve today? a.roasted chicken b.grilled chicken c.fried chicken or d.curry chicken",
    "Squirrels squirrels squirrels squirrels squirrels", "[Luke:] I can’t believe it. [Yoda:] That is why you fail."];

    $("#findScheduleRealtime").click(function(event) {
        event.preventDefault();
        $(".alert").hide();
        if ($("#buildingRealtime").val() != "") {
            $.ajax({
                url: 'scraper.php',
                data: {
                    'building': $("#buildingRealtime").val()
                },
                success: function(response) {
                    if (response == '') {
                        $("#fail").html("Sorry, couldn't find any class... " + messages[Math.floor((Math.random() * 11))]).fadeIn();
                    }
                    else {
                        $("#success").html(response).fadeIn();
                    }
                }
            });
        } else {
            $("#noBuilding").fadeIn();
        }
    });

    $("#findSchedulePlan").click(function(event) {
        event.preventDefault();
        $(".alert").hide();
        if ($("#buildingPlan").val() != "") {
            $.ajax({
                url: 'scraper.php',
                data: {
                    'building': $("#buildingPlan").val(),
                    'dw': $("#dw").val(),
                    'hr': $("#hr").val()
                },
                success: function(response) {
                    if (response == '') {
                        $("#fail").fadeIn();
                    }
                    else {
                        $("#success").html(response).fadeIn();
                    }
                }
            });
        } else {
            $("#noBuilding").fadeIn();
        }
    });

    </script>

    </body>
</html>
