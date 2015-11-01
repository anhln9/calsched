$.getJSON( "api/buildingsAtoG.json", function( data ) {
  var items = [];
  $.each( data, function( key, row ) {
      items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
  });

  $( "<ul/>", {
      html: items.join( "" )
  }).appendTo( "#buildingListAtoG" );
});

$.getJSON( "api/buildingsHtoM.json", function( data ) {
  var items = [];
  $.each( data, function( key, row ) {
      items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
  });

  $( "<ul/>", {
      html: items.join( "" )
  }).appendTo( "#buildingListHtoM" );
});

$.getJSON( "api/buildingsNtoZ.json", function( data ) {
  var items = [];
  $.each( data, function( key, row ) {
      items.push( " <li>"+row.Name+" <a href='#'>"+row.Abbr+"</a></li>" );
  });

  $( "<ul/>", {
      html: items.join( "" )
  }).appendTo( "#buildingListNtoZ" );
});