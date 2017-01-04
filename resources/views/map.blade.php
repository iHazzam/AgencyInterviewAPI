@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">Property Map</div>

                    <div class="panel-body">
                        <form id="formid">
                            <div class="tabs">
                                <ul class="tab-links">
                                    <li class="active"><a href="#tab1">All Properties</a></li>
                                    <li><a href="#tab2">My Properties</a></li>
                                    <li><a href="#tab3">Search Properties</a></li>
                                </ul>

                                <div class="tab-content">
                                    <p>See all properties on the map! Click the icons to see more</p>
                                    <input class="button" name="submit1" type="submit" value="Refresh Map" onclick=" event.preventDefault(); initMap()" />
                                    <div id="tab1" class="tab">
                                        <p>See all properties on the map! Click the icons to see more</p>
                                        <input class="button" name="submit1" type="submit" value="Refresh Map" onclick=" event.preventDefault(); initMap()" />
                                    </div>

                                    <div id="tab2" class="tab">
                                        <p>See your own properties on the map</p>
                                        <input type="hidden" id="uid" name="uid" value="{{Auth::user()->id}}" />
                                        <input class="button" name="submit2" type="submit" value="Refresh Map" onclick="event.preventDefault(); regenerateMapID()" />
                                    </div>

                                    <div id="tab3" class="tab">
                                        <p>See all properties with in a radius (km) of a postcode</p>
                                        <table width="200" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><label for="postcode">Postcode*:</label>
                                                    <input type="text" id="postcode" name="postcode" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="radius">Radius*:</label>
                                                    <input type="text" id="radius" name="radius" />
                                                </td>
                                            </tr>
                                        </table>
                                        <input class="button" name="submit3" type="submit" value="Search" onclick="event.preventDefault(); regenerateMapPostcodeRadius()" />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="hold">
                            <div id="map" style="height: 70vh" class="mapstuff"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
    <script src="/js/map.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4tMgvWE8XQ_jirYRxItoxv4TVow3x-rE&callback=initMap"></script>
@endsection