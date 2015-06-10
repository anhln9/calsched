<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Find classes in progress</title>

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

    <style>

    .alert {
        display:none;
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

                <h4>Today is <?php date_default_timezone_set("America/Los_Angeles"); echo date("l"). ", " .date("h:i"). " " . date("a"); ?></h4>

                <div id="success" class="alert alert-success">Success!</div>
                <div id="fail" class="alert alert-danger">

                <?php //Chooses a random number 

                $num = Rand (1,8); 
                //Based on the random number, gives a quote 
                switch ($num) {
                    case 1: echo "Time is money.";
                    break;
                    case 2: echo "An apple a day keeps the doctor away.";
                    break;
                    case 3: echo "Elmo loves dorthy.";
                    break;
                    case 4: echo "Off to see the wizard.";
                    break;
                    case 5: echo "Tomorrow is another day.";
                    break;
                    case 6: echo "Oh yeah, I need to sleep. Zzzzz.";
                    break;
                    case 7: echo "Do you honestly think that people still teach at this hour?";
                    break;
                    case 8: echo "I want BBQ chicken dipped in sweet and spicy sauce with ten cheese sticks on the side."
                }

                ?>

                </div>

                <div id="noBuilding" class="alert alert-danger">Please REALLY enter a building name.</div>

            </div>

            <div class="col-md-10 col-md-offset-1">

                <h4>List of buildings:</h4>

            Bancroft Library    BANCROFT LIB
Horace A. Barker Hall   BARKER
David Prescott Barrows Hall     BARROWS
Stephan D. Bechtel Engineering Center   BECHTEL
Sibley Auditorium (Bechtel)     BECHTEL AUD
Raymond Thayer Birge Hall   BIRGE
Richard C. Blum Hall    BLUM
Boalt Hall, Law School  BOALT
Botanical Gardens   BOT GARDEN
California Hall     CALIFORNIA
Calvin Laboratory   CALVIN LAB
William Wallace Campbell Hall   CAMPBELL
William Wallace Campbell Annex  CAMPBELL ANX
Channing Courts (Ellsworth Street)  CHANNING CTS
Cesar E. Chavez Student Center  CHAVEZ
Earl F. Cheit Classroom Wing    CHEIT
Clarence Linus Cory Hall    CORY
Raymond Earl Davis Hall     DAVIS
Doe (Main) Library  DOE LIBRARY
Donner Laboratory   DONNER LAB
Henry Durant Hall   DURANT
Durham Studio Theatre (Dwinelle)    DURHAM THTRE
John W. Dwinelle Hall   DWINELLE
Dwinelle Hall Annex     DWINELLE AN
Eshleman Hall   ESHLEMAN
Bernard Alfred Etcheverry Hall  ETCHEVERRY
Griffith Conrad Evans Hall  EVANS
The Faculty Club    FACULTY CLUB
Foothill Residential Complex Building 1     FOOTHILL 1
Foothill Residential Complex Building 4     FOOTHILL 4
David Gardner Stacks (Doe Library)  GARDNERSTACK
A. P. Giannini Hall     GIANNINI
William F. Giauque Hall     GIAUQUE
Daniel Coit Gilman Hall     GILMAN
Genetic and Plant Biology Building  GPB
Goldman School of Public Policy     GSPP
Haas School of Business Faculty Wing    HAAS
Haas Pavilion   HAAS PAVIL
Handball Courts (RSF)   HANDBALL CTS
Jean Hargrove Music Library     HARGROVE LIB
J. T. and Hannah N. Haviland Hall   HAVILAND
Hearst Field Annex  HEARST ANNEX
Hearst East Pool    HEARST EPOOL
Phoebe Apperson Hearst Gymnasium    HEARST GYM
Hearst Memorial Mining Building     HEARST MIN
Hearst Pool     HEARST POOL
Hearst Gym Tennis Courts    HEARSTGYMCTS
Phoebe Apperson Hearst Museum of Anthropology   HEARSTMUSEUM
Alfred Hertz Memorial Hall  HERTZ
Hesse Hall  HESSE
Joel Henry Hildebrand Hall  HILDEBRAND
Hilgard Hall    HILGARD
International House     INTN'L HOUSE
Clark Kerr Campus Building 1    KERR CAMPUS
Daniel E. Koshland Jr. Hall     KOSHLAND
Alfred L. Kroeber Hall  KROEBER
Wendell M. Latimer Hall     LATIMER
John Lawrence LeConte Hall  LECONTE
Gilbert N. Lewis Hall   LEWIS
Lawrence Hall of Science    LHS
Life Sciences Building Addition     LSA
John McCone Hall    MCCONE
McEnerney Hall (1750 Arch Street)   MCENERNEY
Donald Hamilton McLaughlin Hall     MCLAUGHLIN
California Memorial Stadium     MEMORIAL STD
Ralph S. Minor Hall     MINOR
Ralph S. Minor Hall Addition    MINOR ADDITN
Martin Luther King Student Union    MLK ST UNION
James K. Moffitt Undergraduate Library  MOFFITT
Agnes Fay Morgan Hall   MORGAN
May T. Morrison Hall    MORRISON
Bernard Moses Hall  MOSES
Walter Mulford Hall     MULFORD
North Gate Hall     NORTH GATE
O'Brien Hall    OBRIEN
Off Campus  OFF CAMPUS
Pacific Film Archive    PAC FILM ARC
Pauley Ballroom (ASUC)  PAULEY
Plant and Microbial Biology Greenhouse  PB GREENHOUS
George C. Pimentel Hall     PIMENTEL
Zellerbach Playhouse    PLAYHOUSE
Racquetball Courts (RSF)    RAQBALL CTS
Recreational Sports Facility    REC SPRT FAC
Richmond Field Station 112  RFS 112
Recreational Sports Facility Field House    RSF FLDHOUSE
Charles and Helen Soda Hall     SODA
South Annex     SOUTH ANNEX
South Hall  SOUTH HALL
Spieker Aquatics Complex (RSF)  SPIEKER POOL
Robert Gordon Sproul Hall   SPROUL
Squash Courts (RSF)     SQUASH CTS
Wendell Meredith Stanley Hall   STANLEY
Cornelius Vander Starr East Asian Library   STARR LIB
Stephens Hall   STEPHENS
Sutardja Dai Hall   SUTARDJA DAI
Tan Kah Kee Hall    TAN
Tang Center (University Health Services)    TANG CENTER
Edward Chace Tolman Hall    TOLMAN
UC Berkeley Art Museum  UCB ART MUSE
Residence Hall Unit I Cheney    UNIT I CHNY
Residence Hall Unit I Christian     UNIT I CHRST
Residence Hall Unit I Central   UNIT I CNTRL
Residence Hall Unit II Central  UNIT II CNTL
Residence Hall Unit II Towle    UNIT II TOWL
Residence Hall Unit II Wada     UNIT II WADA
Residence Hall Unit III Dining  UNIT III DIN
University Hall     UNIV HALL
Valley Life Sciences Building   VALLEY LSB
Harry Richard Wellman Hall  WELLMAN
Wellman Courtyard Trailers  WELLMAN CRT
Benjamin Ide Wheeler Hall   WHEELER
William W. and Catherine Bauer Wurster Hall     WURSTER
Mr. & Mrs. Isadore Zellerbach Hall  ZELLERBACH

</div>
        </div>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script>

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
