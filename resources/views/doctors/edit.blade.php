@extends('layouts.app')


@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Doctor Profile</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('doctor.index') }}"> Back</a>

            </div>

        </div>

    </div>



    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <form action="{{ route('doctor.update',$doctor->id) }}" method="POST">

        @csrf

        @method('PUT')



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <textarea class="form-control" name="Name" placeholder="Name">{{ $doctor->Name }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>SAMA Number:</strong>

                    <textarea class="form-control" name="sama_number" placeholder="sama_number">{{ $doctor->sama_number }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Qualifications:</strong>

                    <textarea class="form-control" name="Qualifications" placeholder="Qualifications">{{ $doctor->Qualifications }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Specialization:</strong>

                    <select class="form-control" name="specialization">
                        <option value="">--Select--</option>
                        @foreach( $specializations as $specialization)
                            <option value="{{ $specialization->name }}" {{ ($doctor->specialization) == $specialization->name ? 'selected' : '' }}>{{$specialization->name}}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Contact Number:</strong>

                    <input type="number" class="form-control" name="Contact_Number" placeholder="Contact Number" value="{{ $doctor->Contact_Number }}">

                </div>

            </div>

            <!-- <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Start Date:</strong>

                    <select class="form-control" name="start_date">
                        <option value="Monday" {{ ($doctor->start_date) == 'Monday' ? 'selected' : '' }}>Monday</option>
                        <option value="Tuesday" {{ ($doctor->start_date) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                        <option value="Wednesday" {{ ($doctor->start_date) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                        <option value="Thursday" {{ ($doctor->start_date) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                        <option value="Friday" {{ ($doctor->start_date) == 'Friday' ? 'selected' : '' }}>Friday</option>
                        <option value="Saturday" {{ ($doctor->start_date) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                        <option value="Sunday" {{ ($doctor->start_date) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                    </select>

                </div>

            </div> -->

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Available Time:</strong>

                    <textarea class="form-control" name="available_time" placeholder="$doctor->available_time">{{ $doctor->available_time }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Email:</strong>

                    <textarea class="form-control" name="Email" placeholder="Email">{{ $doctor->Email }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Other Options:</strong>

                    <textarea class="form-control" name="other_option" placeholder="Write down your options">{{ $doctor->other_option }}</textarea>

                </div>

            </div>

{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}

{{--                <div class="form-group">--}}

{{--                    <strong>File Name:</strong>--}}

{{--                    <textarea class="form-control" name="file_name" placeholder="file_name">{{ $doctor->file_name }}</textarea>--}}

{{--                </div>--}}

{{--            </div>--}}

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>



    </form>

@endsection
