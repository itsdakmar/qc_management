<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <style>
        @media print {
            .break-always {
                page-break-before: always;
            }

            .break-auto {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>


<div class="main-content">
    <div class="container mt-4">
        <table class="table table-bordered">
            <tr>
                <td style="width: 20%">Report Name</td>
                <td style="width: 80%">{{ $defect->name }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Priority</td>
                <td style="width: 80%">{{ $defect->priority_title }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Status</td>
                <td style="width: 80%">{{ $defect->status_title }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Person in charge</td>
                <td style="width: 80%">{{ $defect->pic }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Issue created</td>
                <td style="width: 80%">{{ $defect->datetime_issue }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Defect type</td>
                <td style="width: 80%">{{ $defect->defectType->name }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Defect description</td>
                <td style="width: 80%">{{ $defect->defect_desc }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Responsibility by</td>
                <td style="width: 80%">{{ $defect->responsibility->name }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Remark</td>
                <td style="width: 80%">{{ $defect->remark }}</td>
            </tr>
            <tr>
                <td style="width: 20%">Latitude</td>
                <td style="width: 80%">{{ $defect->latitude }}</td>
            </tr>
            <tr>
                <td style="width: 20%">longitude</td>
                <td style="width: 80%">{{ $defect->longitude }}</td>
            </tr>

            <tr>
                <td colspan="2">Images Before</td>
            </tr>
            @foreach($images as $image)
                <tr>
                    <td colspan="2">
                        <img class="img-thumbnail" src="{{ url('uploads/images',$image->url) }}"
                             alt="{{ $defect->name }}">
                    </td>
                </tr>
            @endforeach
        </table>

        <table class="table table-bordered break-always">
            <tr>
                <td colspan="2">Drawing</td>
            </tr>
            <tr>
                <td colspan="2">
                    <img class="img-thumbnail" src="{{ $defect->drawing_path  }}"
                         alt="{{ $defect->name }}">
                </td>
            </tr>
        </table>


        @if($defect->status == 3)
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">Closed Report</td>
                </tr>
                <tr>
                    <td style="width: 20%">Closed Report Remark</td>
                    <td style="width: 80%">{{ $defect->closed_remark }}</td>
                </tr>
                <tr>
                    <td style="width: 20%">Closed Report Date</td>
                    <td style="width: 80%">{{ $defect->closed_date }}</td>
                </tr>

            </table>

            <table class="table table-bordered break-auto">
                <tr>
                    <td colspan="2">Images After</td>
                </tr>
                @foreach($images_closed as $image)
                    <tr>
                        <td colspan="2">
                            <img class="img-thumbnail" src="{{ url('uploads/images',$image->url) }}"
                                 alt="{{ $defect->name }}">
                        </td>
                    </tr>
                @endforeach

            </table>
        @endif
    </div>
</div>
<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>

<script type="application/javascript">
    $(document).ready(function(){
        window.print()
    })
</script>
</body>
</html>