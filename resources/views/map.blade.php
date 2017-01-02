@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Property Map</div>

                    <div class="panel-body">
                        <div id="hold">
                            <div id="map" style="height: 70vh" class="mapstuff"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display:none;"><script >var place_array = <?php echo json_encode($properties) ?>;</script></div>
@endsection
@section('js')

    <script src="/js/map.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4tMgvWE8XQ_jirYRxItoxv4TVow3x-rE&callback=initMap"></script>
@endsection