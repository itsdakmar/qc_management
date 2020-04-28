@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Defect Reporting')])

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Update Reporting Information') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('case.show', $defect) }}"
                                   class="btn btn-sm btn-primary">{{ __('Back to report information') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('case.update' , $defect) }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">{{ __('Defect information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Please enter defect report name') }}"
                                           value="{{ old('name', $defect->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('pic') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-pic">{{ __('Person in charge') }}</label>
                                    <input type="text" name="pic" id="input-pic"
                                           class="form-control form-control-alternative{{ $errors->has('pic') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Please enter person in charge') }}"
                                           value="{{ old('pic', $defect->pic) }}" required autofocus>

                                    @if ($errors->has('pic'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pic') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('datetime_issue') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">{{ __('Issue date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input id="input-date" name="datetime_issue"
                                               class="form-control datepicker form-control-alternative{{ $errors->has('datetime_issue') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Issue date') }}" value="{{ old('datetime_issue', $defect->datetime_issue) }}"
                                               required type="text">

                                        @if ($errors->has('datetime_issue'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('datetime_issue') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('defect_type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="defect_type_dropdown">Defect type</label>
                                    <select name="defect_type"
                                            class="form-control form-control-alternative{{ $errors->has('defect_type') ? ' is-invalid' : '' }}"
                                            id="defect_type_dropdown">
                                        <option value="">Please select defect type</option>
                                        @foreach($defectTypes as $defectType)
                                            <option {{ old('defect_type', $defect->defect_type) == $defectType->id ? 'selected' : '' }} value="{{ $defectType->id }}">{{ $defectType->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('defect_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('defect_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('defect_desc') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-defect-desc">{{ __('Defect description') }}</label>
                                    <input type="text" name="defect_desc" id="input-defect-desc"
                                           class="form-control form-control-alternative{{ $errors->has('defect_desc') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Please enter defect description') }}"
                                           value="{{ old('defect_desc', $defect->defect_desc) }}" autofocus>

                                    @if ($errors->has('defect_desc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('defect_desc') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('responsibility') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="responsibility_dropdown">Responsibility to
                                        fix</label>
                                    <select name="responsibility_by"
                                            class="form-control form-control-alternative{{ $errors->has('responsibility') ? ' is-invalid' : '' }}"
                                            id="responsibility_dropdown">
                                        <option value="">Please select responsibility</option>
                                        @foreach($responsibilities as $responsibility)
                                            <option {{ old('responsibility_by', $defect->responsibility_by) == $responsibility->id ? 'selected' : '' }} value="{{ $responsibility->id }}">{{ $responsibility->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('responsibility'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('responsibility') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                                    <label class="form-control-label pr-4">Priority</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_1" name="priority"  value="1"
                                               class="custom-control-input" {{ old('priority', $defect->priority) == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label " for="priority_1">Low</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_2" name="priority" value="2"
                                               class="custom-control-input" {{ old('priority', $defect->priority) == 2 ? 'checked' : '' }}>
                                        <label class="custom-control-label text-green" for="priority_2">Medium</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_3" name="priority" value="3"
                                               class="custom-control-input" {{ old('priority', $defect->priority) == 3 ? 'checked' : '' }}>
                                        <label class="custom-control-label text-yellow" for="priority_3">High</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_4" name="priority" value="4"
                                               class="custom-control-input" {{ old('priority', $defect->priority) == 4 ? 'checked' : '' }}>
                                        <label class="custom-control-label text-red" for="priority_4">Urgent</label>
                                    </div>

                                    @if ($errors->has('priority'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('remark') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-remark">{{ __('Remark') }}</label>
                                    <input type="text" name="remark" id="input-remark"
                                           class="form-control form-control-alternative{{ $errors->has('remark') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Please enter remark') }}" value="{{ old('remark', $defect->remark) }}"
                                           required autofocus>

                                    @if ($errors->has('remark'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remark') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ ($errors->has('lat') || $errors->has('lng')) && ' has-danger' }}">
                                    <label class="form-control-label" for="search-map">{{ __('Location') }}</label>
                                    <input type="text" id="search-map"
                                           class="form-control form-control-alternative{{ ($errors->has('lat') || $errors->has('lng')) && ' is-invalid'  }}"
                                           placeholder="{{ __('Please enter location') }}">
                                    <small class="form-text text-muted">Drag marker to point at your desire location.
                                    </small>

                                    <label>Latitude: <span><b id="lat-span"></b></span> Longitude: <span><b
                                                    id="lng-span"></b></span></label>

                                    @if ($errors->has('lat') || $errors->has('lng'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Latitude & Logitude is required.</strong>
                                        </span>
                                    @endif

                                    <div id="map" class="mt-4" style="height: 600px"></div>
                                    <input type="hidden" name="latitude" id="lat" data-latitude="{{ $defect->latitude }}" class="form-control form-control-alternative">
                                    <input type="hidden" name="longitude" id="lng" data-longitude="{{ $defect->longitude }}" class="form-control form-control-alternative">

                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                            class="btn bg-gradient-success btn-block text-white mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @push('js')

            <script src="{{ asset('argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
            <script type="application/javascript">
                $('#caseFile').on('change', function () {
                    let filename = ($(this)[0].files[0]) ? $(this)[0].files[0].name : 'Please Select File';
                    $('#file-label').html(filename);
                });

                $('#image').on('change', function () {
                    let files = $(this)[0].files;
                    let choosenFile = '';

                    for (var i = 0; i < files.length; i++)
                    {
                        if(i === 0){
                            choosenFile += files[i].name ;
                        }else {
                            choosenFile += ', '+files[i].name ;
                        }
                    }

                    $('#image-label').html(choosenFile);
                });
            </script>

            <script>
                let gm, marker, searchBox, infoWindow;
                let markers = [];
                let coordinate = {
                    "lat" : parseFloat(document.getElementById('lat').dataset.latitude),
                    "lng" : parseFloat(document.getElementById('lng').dataset.longitude)
                };

                function initMap() {
                    gm = new google.maps.Map(document.getElementById('map'), {
                        center: coordinate,
                        zoom: 15
                    });

                    marker = new google.maps.Marker({
                        position: coordinate,
                        map: gm,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                    });

                    infoWindow = new google.maps.InfoWindow;

                    updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());

                    searchBox = new google.maps.places.SearchBox(document.getElementById('search-map'));

                    searchBox.addListener('places_changed', function () {
                        var places = searchBox.getPlaces();

                        if (places.length === 0) {
                            return;
                        }

                        marker.setMap(null);

                        // For each place, get the icon, name and location.
                        var bounds = new google.maps.LatLngBounds();
                        places.forEach(function (place) {
                            if (!place.geometry) {
                                console.log("Returned place contains no geometry");
                                return;
                            }

                            // Create a marker for each place.
                            marker = new google.maps.Marker({
                                position: place.geometry.location,
                                title: place.name,
                                map: gm,
                                draggable: true,
                            });

                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });
                        gm.fitBounds(bounds);
                        updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());

                        google.maps.event.addListener(marker, 'position_changed', function () {
                            updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
                        });
                    });

                    google.maps.event.addListener(marker, 'position_changed', function () {
                        updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
                    });
                }

                function updateLatLng(lat, lng) {
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                    $('#lat-span').text(lat);
                    $('#lng-span').text(lng);
                }

                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(map);
                }
            </script>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEO8cFMy0w8ei7v6yq0B_ZiTPT_levnS4&callback=initMap&libraries=places"
            ></script>
        @endpush
        @include('layouts.footers.auth')
    </div>
@endsection
