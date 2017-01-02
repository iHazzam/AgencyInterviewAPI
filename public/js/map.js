
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:54.5, lng: -3.7},
        zoom: 6
    });
    var marker;
    var infowindow = new google.maps.InfoWindow();
    for (i = 0; i < place_array.length; i++) {
        console.log(place_array[i]);
        var obj = place_array[i];
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
function bindInfoWindow(marker, map, infowindow, content) {
    marker.addListener('click', function() {
        infowindow.setContent(content);
        infowindow.open(map, this);
    });
}

function regenerateMapID(id)
{
    $.get('/map/'+id, function(data){
        if(data)
        {
            var newplaces = JSON.parse(data);
            console.log(obj);
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat:54.5, lng: -3.7},
                zoom: 6
            });
            var marker;
            var infowindow = new google.maps.InfoWindow();
            for (i = 0; i < newplaces.length; i++) {
                console.log(newplaces[i]);
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

function regenerateMapPostcodeRadius(postcode,radius)
{
    $.get('/map/postrad/'+postcode+'/'+radius, function(data){
        if(data)
        {
            var newplaces = JSON.parse(data);
            console.log(obj);
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat:54.5, lng: -3.7},
                zoom: 6
            });
            var marker;
            var infowindow = new google.maps.InfoWindow();
            for (i = 0; i < newplaces.length; i++) {
                console.log(newplaces[i]);
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