<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Find classes in progress</title>
    <!-- App is deployed at https://calsched.herokuapp.com -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <style>

    .alert {
        display:none;
    }

    .center {
        text-align: center;
    }

    ul {
        list-style-type: none;
    }

    hr {
        margin-top: 20px;
        border: 0;
        border-top: 2px solid #addff9;
        border-bottom: 2px solid #ffffff;
    }

    </style>

</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <h3>Find classes that are happening across campus</h3>

                <h4>Current: Fall 2015 Schedule</h4>

                <form>
                    <div class="form-group">
                        <input type="text" id="building" name="building" class="form-control" placeholder="E.g. Dwinelle, Stanley, ..."/>
                    </div>

                    <button id="findSchedule" class="btn btn-success btn-lg">Find Schedule</button>

                </form>

                <h4>Today is 
                    <?php date_default_timezone_set("America/Los_Angeles"); echo date("l"). ", "; ?>
                    <span id="hours"><?=date('H');?></span>:<span id="minutes"><?=date('i');?></span>:<span id="seconds"><?=date('s');?></span>
                </h4>

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

                <div id="success" class="alert alert-success">Success!</div>
                <div id="fail" class="alert alert-danger">Sorry, couldn't find any class. 

                <?php //Chooses a random number 

                $num = Rand (1,9); 
                //Based on the random number, gives a quote 
                switch ($num) {
                    case 1: echo "Go feed the birds.";
                    break;
                    case 2: echo "Andddd an apple a day keeps the doctor away.";
                    break;
                    case 3: echo "Elmo loves Dorthy.";
                    break;
                    case 4: echo "I'm off to see the wizards.";
                    break;
                    case 5: echo "But tomorrow is another day.";
                    break;
                    case 6: echo "Oh yeah, I need to sleep. Zzzzz.";
                    break;
                    case 7: echo "Want some BBQ chicken dipped in sweet and spicy sauce with ten cheese sticks on the side?";
                    break;
                    case 8: echo "Time for tea.";
                    break;
                    case 9: echo "No soup for you!";
                    break;
                }

                ?>

                </div>

                <div id="noBuilding" class="alert alert-danger">That's not really a building name, check the list below!</div>

            </div>

        </div>

        <div class="row">

            <h3>List of buildings:</h3>

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
        $("div a").click(function() {
            alert('clicked');
            var value = $(this).html();
            var input = $('#building');
            input.val(value);
        });
    });

    $("#findSchedule").click(function(event) {
        event.preventDefault();
        $(".alert").hide();
        if ($("#building").val() != "") {
            $.ajax({
                url: 'scraper.php',
                data: {
                    'building': $("#building").val()
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
