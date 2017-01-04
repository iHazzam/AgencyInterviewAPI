
var map;
function initMap() {
    $.get('/api/public/properties', function(data) {
        if (data) {
            //console.log(data);
            var propertieslist = data;
            $.get('/api/public/users', function (data2) {
                if (data2) {
                    var userslist = data2;
                    var place_array = formatPlaceData(propertieslist, userslist);
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: 54.5, lng: -3.7},
                        zoom: 6
                    });
                    var marker;
                    var infowindow = new google.maps.InfoWindow();
                    //console.log(place_array);
                    for (x = 0; x < Object.keys(place_array).length-1; x++) {
                        //console.log(place_array[x], x);
                        var obj = place_array[x];
                        name_str = obj.name;
                        value_str = obj.value;
                        owner_str = obj.owner;
                        lati = obj.lati;
                        lngi = obj.lngi;
                        contentString =
                            '<div id="holder">' +
                            '<h3 class="boldme">Property name: ' + name_str + '</h3>' +
                            '<h4 class="boldme">(Property value: ' + value_str + ')</h4>' +
                            '<hr width="60%">' +
                            '<h4 class="boldme">Owner name:</h4>' +
                            '<p>' + owner_str + '</p>' +
                            '<h4 class="boldme">Co-ordinates</h4>' +
                            '<p>' + lati + ',' + lngi + '</p>' +
                            '</div>';
                        var coords = {};
                        var title = obj.name;
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lati, lngi),
                            map: map,
                            title: title
                        });
                        bindInfoWindow(marker, map, infowindow, contentString);
                    }
                }
            });
        }
    });
}


function bindInfoWindow(marker, map, infowindow, content) {
    marker.addListener('click', function() {
        infowindow.setContent(content);
        infowindow.open(map, this);
    });
}

function regenerateMapID()
{
    var id = document.getElementById('uid').value;
    $.get('api/public/properties/uid/'+id, function(data) {
        if (data) {
            var propertieslist = data;
            $.get('/api/public/users', function (data2) {
                if (data2) {
                    var userslist = data2;
                    var newplaces = formatPlaceData(propertieslist, userslist);
                    //console.log(propertieslist);
                    //console.log(userslist);
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat:54.5, lng: -3.7},
                        zoom: 6
                    });
                    var marker;
                    var infowindow = new google.maps.InfoWindow();
                    for (i = 0; i < Object.keys(newplaces).length-1; i++) {
                        //console.log(newplaces[i]);
                        var obj = newplaces[i];
                        name_str = obj.name;
                        value_str = obj.value;
                        owner_str = obj.owner;
                        lati = obj.lati;
                        lngi = obj.lngi;
                        contentString =
                            '<div id="holder">'+
                            '<h3 class="boldme">Property name:' + name_str +'</h3>'+
                            '<h4 class="boldme">(Property value:' + value_str + ')</h4>'+
                            '<hr width="60%">'+
                            '<h4 class="boldme">Owner name:</h4>'+
                            '<p>'+ owner_str +'</p>'+
                            '<h4 class="boldme">Co-ordinates</h4>'+
                            '<p>'+ lati + ',' + lngi + '</p>'+
                            '</div>';
                        var coords = {};
                        var title = obj.name;
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lati,lngi),
                            map: map,
                            title: title
                        });
                        bindInfoWindow(marker, map, infowindow, contentString);
                    }

                }
            });
        }
    });
}

function regenerateMapPostcodeRadius()
{
    var postcode = document.getElementById('postcode').value;
    var radius = document.getElementById('radius').value;

    $.get('https://api.postcodes.io/postcodes/' + postcode, function (data0) {
       if(data0){
           //console.log(data0);
           var lat = data0['result']['latitude'];
           var lng = data0['result']['longitude'];
           $.get('api/public/properties/rad/'+ lat + '/' + lng + '/' + radius, function(data) {
               if (data) {
                   var propertieslist = data;
                   //console.log(propertieslist);
                   $.get('/api/public/users', function (data2) {
                       if (data2) {
                           var userslist = data2;
                           var newplaces = formatPlaceData(propertieslist, userslist);
                           map = new google.maps.Map(document.getElementById('map'), {
                               center: {lat:54.5, lng: -3.7},
                               zoom: 6
                           });
                           var marker;
                           var infowindow = new google.maps.InfoWindow();
                           for (i = 0; i < Object.keys(newplaces).length-1; i++) {
                               var obj = newplaces[i];
                               name_str = obj.name;
                               value_str = obj.value;
                               owner_str = obj.owner;
                               lati = obj.lati;
                               lngi = obj.lngi;
                               contentString =
                                   '<div id="holder">'+
                                   '<h3 class="boldme">Property name:' + name_str +'</h3>'+
                                   '<h4 class="boldme">(Property value:' + value_str + ')</h4>'+
                                   '<hr width="60%">'+
                                   '<h4 class="boldme">Owner name:</h4>'+
                                   '<p>'+ owner_str +'</p>'+
                                   '<h4 class="boldme">Co-ordinates</h4>'+
                                   '<p>'+ lati + ',' + lngi + '</p>'+
                                   '</div>';
                               var coords = {};
                               var title = obj.name;
                               marker = new google.maps.Marker({
                                   position: new google.maps.LatLng(lati,lngi),
                                   map: map,
                                   title: title
                               });
                               bindInfoWindow(marker, map, infowindow, contentString);
                           }
                       }
                   });

               }
           });
       }
    });


}

function formatPlaceData(properties, users) {
    properties = properties['data'];
    users = users['data'];
    var formattedProperties = {};
    for (var k in properties) {
        formattedProperties[k] = {
            name : properties[k]['name'],
            value : '£' + properties[k]['value'],
            owner : users[properties[k]['uid']],
            lati : properties[k]['lat'],
            lngi :properties[k]['lng']
        };
    }
    return(formattedProperties);
}

//used from source (not my code)
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
    });
});