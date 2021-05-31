@extends('layouts.app')
@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">
{{--            <img src="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}"--}}
{{--                 class="img-circle elevation-2"--}}
{{--                 alt="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}">--}}

            <div class="pull-left">

                <h2>{{ $ambulance->name }}</h2>
                @if($ambulance->profile_image != 'null')
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($ambulance->profile_image) }}"
                         class="img"
                         alt="{{ \Illuminate\Support\Facades\Storage::url($ambulance->profile_image) }}">

                @endif
                {{-- <img src="{{ \Illuminate\Support\Facades\Storage::url($ambulance->profile_image) }}"
                    class="img" alt="{{ \Illuminate\Support\Facades\Storage::url($ambulance->profile_image) }}"> --}}
                    
            </div>

        </div>

    </div>

    <div class="row" style="padding: 20px">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Charity Service:</strong>

                {{ $ambulance->charity_service }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Address:</strong>

                {{ $ambulance->address }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Contact_Number:</strong>

                {{ $ambulance->contact_number }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                {{ $ambulance->email }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Available Time:</strong>

                {{ $ambulance->available_time }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Comment:</strong>

                {{ $ambulance->comment }}

            </div>

        </div>

    </div>

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('ambulance.index') }}"> Back</a>

            </div>

        </div>

    </div>

@endsection
