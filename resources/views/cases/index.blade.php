@extends('layouts.app', ['title' => __('User Management')])


@section('content')
    @include('layouts.headers.cards', compact('totalCount','createdCount','inProgressCount','closedCount'))

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

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-hover table-flush">
                            <thead class="thead-light">
                            <tr>
                                {{--                                    <th scope="col">{{ __('Image') }}</th>--}}
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Issue Date') }}</th>
                                <th scope="col">{{ __('Person in charge') }}</th>
                                <th scope="col">{{ __('Defect type') }}</th>
                                <th scope="col">{{ __('Responsibility to fix') }}</th>
                                <th scope="col">{{ __('Remark') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Priority') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($defects as $defect)
                                <tr data-href="{{ route('case.show', $defect) }}">
                                    {{--                                        <td><img src="{{ $defect->image  }}" width="200px" class="img-thumbnail"></td>--}}
                                    <td>{{ $defect->name }}</td>
                                    <td>{{ $defect->datetime_issue }}</td>
                                    <td>{{ $defect->pic }}</td>
                                    <td>{{ $defect->defectType->name }}</td>
                                    <td>{{ $defect->responsibility->name }}</td>
                                    <td>{{ $defect->remark }}</td>
                                    <td>{!! $defect->status_badge !!}</td>
                                    <td>{!! $defect->priority_badge !!}</td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                @if (auth()->user()->hasRole('main'))
                                                    <form action="{{ route('case.destroy', $defect) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item"
                                                           href="{{ route('case.edit', $defect) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item"
                                                                onclick="confirm('{{ __("Are you sure you want to delete this report?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                    @if($defect->status == 1)
                                                        <form action="{{ route('case.update', $defect) }}"
                                                              method="post">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="status" value="2">
                                                            <button type="button" class="dropdown-item"
                                                                    onclick="confirm('{{ __("Are you sure you want to set this report to in progress?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Set to in progress') }}
                                                            </button>
                                                        </form>
                                                    @elseif($defect->status == 2)
                                                        <a href="#" data-toggle="modal" data-id="{{ $defect->id }}" data-target="#ModalCloseReport"
                                                           class="dropdown-item">
                                                            {{ __('Close report') }}
                                                        </a>
                                                    @endif
                                                @endif
                                                    <a class="dropdown-item"
                                                       href="{{ route('report.generate', ['report_id' => $defect]) }}">{{ __('View & Download Report') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $defects->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalCloseReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('report.close', $defect) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="status" value="3">
                        <input type="hidden" id="modal_report_id" name="report_id" value="">
                        <div class="form-group">
                            <label class="form-control-label" for="input-remark">{{ __('Closing Remarks') }}</label>
                            <input type="text" name="closed_remark" id="input-remark"
                                   class="form-control form-control-alternative"
                                   placeholder="{{ __('Please enter remark') }}" value="{{ old('closed_remark') }}"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"
                                   for="input-images">{{ __('Images') }}</label>
                            <div class="custom-file">
                                <input type="file" accept="image/*" name="image[]"
                                       class="form-control-alternative custom-file-input"
                                       id="closeImage" lang="en" multiple required>
                                <label id="file-images" class="custom-file-label" for="closeImage">Choose images file to
                                    upload</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script type="application/javascript">
            $(document).ready(function () {
                $('table tr td:not(:last-child)').click(function () {
                    window.location = $(this).parent().data('href');
                    return false;
                });

                $('#closeImage').on('change', function () {
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

                    $('#file-images').html(choosenFile);
                });

                $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

                    var data_id = '';

                    if (typeof $(this).data('id') !== 'undefined') {

                        data_id = $(this).data('id');
                    }

                    console.log(data_id)
                    $('#modal_report_id').val(data_id);
                });
            });
        </script>
    @endpush
@endsection