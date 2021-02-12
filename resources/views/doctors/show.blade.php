@extends('layouts.app')
@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Doctor Profile</h2>

            </div>

        </div>

    </div>



    <div class="row" style="padding: 20px">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $doctor->Name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Qualifications:</strong>

                {{ $doctor->Qualifications }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Contact_Number:</strong>

                {{ $doctor->Contact_Number }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                {{ $doctor->Email }}

            </div>

        </div>

    </div>

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('doctor.index') }}"> Back</a>

            </div>

        </div>

    </div>

@endsection
