@extends('layouts.app')

@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Patient Information</h2>

        </div>

    </div>

</div>


<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <h2>
                <strong>Name:</strong>
                {{ $patient->Name }}
            </h2>

        </div>

    </div>

    <div class="card" style="background-color: yellow;padding: 10px">
        <h4 class="text-center" style="border: radius;">Wallet: {{ $patient->wallet }}
        </h4>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Age:</strong>

            {{ $patient->Age }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Gender:</strong>

            {{ $patient->Gender }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Address:</strong>

            {{ $patient->Address }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contact_Number:</strong>

            {{ $patient->Contact_Number }}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('patient.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection