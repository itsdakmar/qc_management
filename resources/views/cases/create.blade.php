@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add User')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Defects Reporting') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('case.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('case.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Defects information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Please enter defect report name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('pic') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Person in charge') }}</label>
                                    <input type="text" name="pic" id="input-name" class="form-control form-control-alternative{{ $errors->has('pic') ? ' is-invalid' : '' }}" placeholder="{{ __('Please enter person in charge') }}" value="{{ old('pic') }}" required autofocus>

                                    @if ($errors->has('pic'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('datetime_issue') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Issue date') }}</label>
                                    <input type="email" name="datetime_issue" id="input-email" class="form-control form-control-alternative{{ $errors->has('datetime_issue') ? ' is-invalid' : '' }}" placeholder="{{ __('Issue date') }}" value="{{ old('datetime_issue') }}" required>

                                    @if ($errors->has('datetime_issue'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('datetime_issue') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('defect_type') ? ' has-danger' : '' }}">
                                    <label for="defect_type_dropdown">Defect type</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('defect_type') ? ' is-invalid' : '' }}"  id="defect_type_dropdown">
                                        <option value="">Please select defect type</option>
                                    @foreach($defectTypes as $defectType)
                                            <option value="{{ $defectType->id }}">{{ $defectType->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('defect_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('defect_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('defect_type') ? ' has-danger' : '' }}">
                                    <label for="defect_type_dropdown">Defect type</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('defect_type') ? ' is-invalid' : '' }}"  id="defect_type_dropdown">
                                        <option value="">Please select defect type</option>
                                        @foreach($defectTypes as $defectType)
                                            <option value="{{ $defectType->id }}">{{ $defectType->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('defect_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('defect_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection