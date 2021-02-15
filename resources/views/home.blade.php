@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

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
                                <select class="form-control" name="doctor_id">
                                    @foreach( $doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{$doctor->Name}}  ({{$doctor->Qualifications}})</option>
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
                <h3 class="text0">Doctor's All Patients in Waiting List</h3>
            </div>
            <div class="card-body" style="display: block">
                <table class="table table-bordered">

                    <tr>

                        <th>No</th>

                        <th>Doctor Name</th>

                        <th>Patient Name</th>

{{--                        <th style="width:280px">Action</th>--}}

                    </tr>

                    @foreach ($doctors as $doctor)

                        <tr>

                            <td>{{ $doctor->id }}</td>

                            <td>{{ $doctor->Name }}</td>

                            @foreach($doctor->patients as $patient)
                                <td>{{ $patient->Name }}</td>
                            @endforeach

{{--                            <td>--}}

{{--                                <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">--}}



{{--                                    <a class="btn btn-info" href="{{ route('doctor.show',$doctor->id) }}">Show</a>--}}



{{--                                    <a class="btn btn-primary" href="{{ route('doctor.edit',$doctor->id) }}">Edit</a>--}}



{{--                                    @csrf--}}

{{--                                    @method('DELETE')--}}



{{--                                    <button type="submit" class="btn btn-danger">Delete</button>--}}

{{--                                </form>--}}

{{--                            </td>--}}

                        </tr>

                    @endforeach

                </table>
            </div>
        </div>

    </div>

@endsection
