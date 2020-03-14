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
                                    <label class="form-control-label" for="input-pic">{{ __('Person in charge') }}</label>
                                    <input type="text" name="pic" id="input-pic" class="form-control form-control-alternative{{ $errors->has('pic') ? ' is-invalid' : '' }}" placeholder="{{ __('Please enter person in charge') }}" value="{{ old('pic') }}" required autofocus>

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

                                <div class="form-group{{ $errors->has('responsibility') ? ' has-danger' : '' }}">
                                    <label for="responsibility_dropdown">Responsibility to fix</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('responsibility') ? ' is-invalid' : '' }}"  id="responsibility_dropdown">
                                        <option value="">Please select responsibility</option>
                                        @foreach($responsibilities as $responsibility)
                                            <option value="{{ $responsibility->id }}">{{ $responsibility->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('responsibility'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('responsibility') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                                    <label class="pr-4">Priority</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_1" name="priority" value="1" class="custom-control-input">
                                        <label class="custom-control-label " for="priority_1">Low</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_2" name="priority" value="2" class="custom-control-input">
                                        <label class="custom-control-label text-green" for="priority_2">Medium</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_3" name="priority" value="3" class="custom-control-input">
                                        <label class="custom-control-label text-yellow" for="priority_3">High</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="priority_4" name="priority" value="4" class="custom-control-input">
                                        <label class="custom-control-label text-red" for="priority_4">Urgent</label>
                                    </div>

                                    @if ($errors->has('responsibility'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('responsibility') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Image') }}</label>
                                    <div class="custom-file">
                                        <input type="file"  name="image" class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}" id="customFileLang" lang="en">
                                        <label class="custom-file-label" for="customFileLang">Select file</label>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('remark') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-remark">{{ __('Remark') }}</label>
                                    <input type="text" name="remark" id="input-remark" class="form-control form-control-alternative{{ $errors->has('remark') ? ' is-invalid' : '' }}" placeholder="{{ __('Please enter remark') }}" value="{{ old('remark') }}" required autofocus>

                                    @if ($errors->has('remark'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remark') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-success btn-block text-white mt-4">{{ __('Save') }}</button>
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