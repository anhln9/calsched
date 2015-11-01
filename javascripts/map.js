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