@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')
    <style>
        .table td {
            padding-bottom: 0.5rem;
            padding-top: 0.5rem;
        }
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Defects Reporting') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('case.create') }}"
                                   class="btn btn-sm btn-primary">{{ __('Add Case') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <h3 class="card-header bg-warning text-white">{{ $defect->name }} <span class="pl-6">Priority : {{ $defect->priority_title }}</span></h3>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Report Information</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>{{ $defect->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Person in charge</td>
                                                            <td>{{ $defect->pic }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Issue created</td>
                                                            <td>{{ $defect->datetime_issue }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Defect type</td>
                                                            <td>{{ $defect->defectType->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Defect description</td>
                                                            <td>{{ $defect->defect_desc }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Responsibility by</td>
                                                            <td>{{ $defect->responsibility->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Priority</td>
                                                            <td>{!! $defect->priority_badge !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Remark</td>
                                                            <td>{{ $defect->remark }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <a class="btn btn-primary btn-block" data-toggle="collapse"
                                                   href="#collapseExample" role="button" aria-expanded="false"
                                                   aria-controls="collapseExample">
                                                    Click to show drawing
                                                </a>
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body mt-4">
                                                        <img class="card-img-top" src="{{ $defect->image  }}"
                                                             alt="{{ $defect->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card">
                                            <div id="gmap" data-lt="{{ $defect->latitude  }}"
                                                 data-lg="{{ $defect->longitude  }}" style="height: 500px"></div>
                                            <div class="card-body">
                                                <h5 class="card-title">Defect Location</h5>
                                                <p class="card-text mb--1">Latitude <span><b>{{ $defect->latitude }}</b></span>.</p>
                                                <p class="card-text">longitude <span><b>{{ $defect->longitude }}</b></span></p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

    @push('js')
        <script>
            let mapId, gmap;

            function initGMap() {

                mapId = document.getElementById('gmap');
                lat = mapId.getAttribute('data-lt');
                lng = mapId.getAttribute('data-lg');

                let myLatlng = new google.maps.LatLng(lat, lng);
                let mapOptions = {
                    zoom: 15,
                    scrollwheel: false,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                };

                gmap = new google.maps.Map(mapId, mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: gmap,
                    animation: google.maps.Animation.DROP,
                    title: 'Hello World!'
                });

                var contentString = '<div class="info-window-content"><h2>Argon Dashboard</h2>' +
                    '<p>A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</p></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(gmap, marker);
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEO8cFMy0w8ei7v6yq0B_ZiTPT_levnS4&callback=initGMap"></script>
    @endpush
@endsection