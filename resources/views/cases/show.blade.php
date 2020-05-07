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
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Defects Reporting') }}, <span class="ml-2">Current Status : {!! $defect->status_pill !!}</span></h3>
                            </div>
                            <div class="col-4 text-right">
                                @if($defect->status == 1 || $defect->staus == 2)
                                <a href="{{ route('case.edit', $defect) }}"
                                   class="btn btn-sm btn-primary">{{ __('Update Report Information') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body" style="background-color: #ced4da1c">
                                {!! $defect->priority_alert !!}
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-bullet-list-67 mr-2"></i>Report Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-album-2 mr-2"></i>Drawing</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-image mr-2"></i>Images</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-like-2 mr-2"></i>Closing Information</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card shadow">
                                    <div class="card-body" >
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card">
                                                            <div id="gmap" data-lt="{{ $defect->latitude  }}"
                                                                 data-lg="{{ $defect->longitude  }}" style="height: 500px"></div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Report Information Location</h5>
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
                                                                        <tr>
                                                                            <td>Latitude</td>
                                                                            <td>{{ $defect->latitude }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>longitude</td>
                                                                            <td>{{ $defect->longitude }}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                @if($defect->status == 1)
                                                                <form method="post" action="{{ route('case.update', $defect) }}">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="status" value="2">
                                                                    <a href="{{ $url }}" target="_blank" class="btn btn-primary">Open on google maps</a>
                                                                    <button type="submit" class="btn btn-info">Set status to in progress</button>
                                                                </form>
                                                                    @else
                                                                    <a href="{{ $url }}" target="_blank" class="btn btn-primary">Open on google maps</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                                <div class="card card-body mt-4">
                                                    <img class="card-img-top" src="{{ $defect->drawing_path  }}"
                                                         alt="{{ $defect->name }}">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                                <div class="card card-body mt-4">
                                                    <div class="row">
                                                        @foreach($images as $image)
                                                            <div class="col">
                                                            <img class="img-thumbnail" src="{{ url('uploads/images',$image->url) }}" alt="{{ $defect->name }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @if($defect->status == 3)
                                                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel"
                                                     aria-labelledby="tabs-icons-text-2-tab">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p>Closed At : <span class="mr-2"><b>{{ $defect->closed_date->format('d / m / Y') }}</b></span>Closed Remark : <span><b>{{ $defect->closed_remark }}</b></span></p>
                                                                    <h5 class="card-title">Closed Images</h5>
                                                                        <div class="row">
                                                                            @foreach($images_closed as $image_closed)
                                                                                <div class="col">
                                                                                    <img class="img-thumbnail" src="{{ url('uploads/images',$image_closed->url) }}" alt="{{ $defect->name }}">
                                                                                </div>
                                                                            @endforeach
                                                                        </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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