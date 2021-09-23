@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif

{{--    <title>Laravel - Dynamic autocomplete search using select2 JS Ajax-nicesnippets.com</title>--}}

{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">--}}

{{--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}

<div class="container-fluid">
    <div class="card card-default" style="display: flex; margin: 20px 0">
        <div class="card-header">
            <h3 class="text0">Assign Doctor for Patient Booking</h3>
        </div>

        <div class="card-body" style="display: block">
            <form method="POST" action="{{ route('assign.store') }}">
                @csrf
                <div class="row" style="display: flex">
                    <div class="col-md-6">
                        <div class="dropdown">
                            <label>Choose Doctor</label>
                            {{--                                <select id='selUser' style='width: 200px;'>--}}
                            {{--                                    @foreach( $doctors as $doctor)--}}
                            {{--                                        <option value="{{ $doctor->id }}">{{$doctor->Name}}
                            ({{$doctor->Qualifications}})</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                                <select class="DoctorName form-control" name="DoctorName"></select>--}}
                            <select class="form-control" name="doctor_id">
                                @foreach( $doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{$doctor->Name}} ({{$doctor->Qualifications}})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <label>Choose Patient</label>
                            <select class="form-control" name="patient_id">
                                @foreach( $patients as $patient)
                                <option value="{{ $patient->id }}">{{$patient->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <br>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Submit</button>

            </form>
        </div>
    </div>

    <div class="card card-default" style="display: flex; margin: 20px 0">
        <div class="card-header">
            <h3 class="text0">Doctor's All Patients</h3>
        </div>
        <div class="card-body" style="display: block">
            <table class="table table-bordered" id="doctors">

                <thead>
                    <tr>

                        <th>No</th>

                        <th>Doctor Name</th>

                        <th>Patient Name</th>

                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($doctors as $doctor)

                    @foreach($doctor->patients as $patient)
                    <tr>

                        <td>{{ $doctor->id }}</td>

                        <td>{{ $doctor->Name }}</td>

                        <td>{{ $patient->Name }}</td>

                        <td>

                            <form action="{{ route('delete_assign') }}" method="POST">

                                @csrf

                                <input type="integer" name="doctor_id" value="{{ $doctor->id }}" class="form-control"
                                    hidden>
                                <input type="integer" name="patient_id" value="{{ $patient->id }}" class="form-control"
                                    hidden>

                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

{{--    <script type="text/javascript">--}}

{{--        $(document).ready(function(){--}}

{{--            $( "#selUser" ).select2({--}}
{{--                ajax: {--}}
{{--                    url: "{{route('getDataAjax')}}",--}}
{{--                    type: "post",--}}
{{--                    dataType: 'json',--}}
{{--                    delay: 250,--}}
{{--                    data: function (params) {--}}
{{--                        return {--}}
{{--                            search: params.term // search term--}}
{{--                        };--}}
{{--                    },--}}
{{--                    processResults: function (response) {--}}
{{--                        return {--}}
{{--                            results: response--}}
{{--                        };--}}
{{--                    },--}}
{{--                    cache: true--}}
{{--                }--}}

{{--            });--}}

{{--        });--}}

{{--    </script>--}}


@endsection

@section('scripts')

<script>
    $(function () {

$('#doctors').DataTable({

"bPaginate": true,
"bLengthChange": false,
"bFilter": true,
"bInfo": true,
"bAutoWidth": false,
"searching": true,
"ordering": true,
"autoWidth": false,
"responsive": true,
});
});
</script>
@endsection