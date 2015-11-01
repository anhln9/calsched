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
    <script src="/calsched/javascripts/map.js"></script>

    <script src="/calsched/javascripts/clock.js"></script>
    <script src="/calsched/javascripts/buildings.js"></script>
    <script src="/calsched/javascripts/search.js"></script>

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
                <h4><a href="/calsched/api/osoc-berkeley-schedule.json">Get API</a></h4>
                <h3 id="description"><a href="/calsched">UC Berkeley Class Lookup</a></h3>

                <div class="row">
                    <div class="col-md-3">
                        <h4>Term:</h4>
                    </div>
                    <div class="col-md-3">
                        <div class="radio">
                            <label><input type="radio" id="semester" value="FL" name="Semester" checked="checked">Fall</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="radio">
                            <label><input type="radio" id="semester" value="SP" name="Semester">Spring</label>
                        </div>
                    </div>
                </div>


                <h4><?php date_default_timezone_set("America/Los_Angeles"); echo date("l"). ", "; ?>
                    <span id="hours"><?=date('H');?></span>:<span id="minutes"><?=date('i');?></span>:<span id="seconds"><?=date('s');?></span>
                </h4>

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
                    <div id="fail" class="alert alert-warning">Sorry, somehow we could not find anything.</div>
                    <div id="noBuilding" class="alert alert-warning">That's not really a building name, check the list below!</div>
                </div>

            </div>

            <div class="col-md-5">
                <div id="map-canvas"></div>
            </div>
        </div>

        <hr>

        <div id="listOfBuildings" class="row">

            <h3 class="center">List of buildings:</h3>

            <div class="col-md-4" id="buildingListAtoG"><h4 class="center">A-G</h4></span></div>

            <div class="col-md-4" id="buildingListHtoM"><h4 class="center">H-M</h4></div>

            <div class="col-md-4" id="buildingListNtoZ"><h4 class="center">N-Z</h4></div>

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

    </script>

    </body>
</html>
