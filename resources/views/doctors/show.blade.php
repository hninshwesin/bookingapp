@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        {{-- <img
            src="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}"
            --}} {{-- class="img-circle elevation-2" --}} {{--
            alt="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}">--}}

        <div class="pull-left">

            <h2>Dr. {{ $doctor->Name }}</h2>

            @if($doctor->DoctorProfilePicture()->exists())
            <img src="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorProfilePicture->profile_picture) }}"
                class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorProfilePicture->profile_picture) }}"
                height="150" width="250">

            @endif

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="card" style="background-color: yellow;padding: 10px">
        <h4 class="text-center" style="border: radius;">Wallet: {{ $doctor->wallet }}
        </h4>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">



            <strong>Qualifications:</strong>

            {{ $doctor->Qualifications }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Specialization:</strong>

            {{ $doctor->specialization }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contact_Number:</strong>

            {{ $doctor->Contact_Number }}

        </div>

    </div>

    <!-- <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Available Date:</strong>

                {{ $doctor->start_date }} to {{ $doctor->end_date }}

            </div>

        </div> -->

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Available Time:</strong>

            {{ $doctor->available_time }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Available Language:</strong>

            @foreach ($doctor->languages as $languages)
            {{$languages->language }} /
            @endforeach

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {{ $doctor->Email }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Other Options:</strong>

            {{ $doctor->other_option }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Certificate:</strong><br>

            @if($doctor->DoctorCertificateFile()->exists())
            @foreach ($doctor->DoctorCertificateFile as $certificate)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($certificate->certificate_file) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($certificate->certificate_file) }}" height="150"
                width="250" style="padding: 5px">
            @endforeach
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Sama Or NRC:</strong><br>

            @if($doctor->DoctorSamaFileOrNrcFile()->exists())
            @foreach ($doctor->DoctorSamaFileOrNrcFile as $SamaFileOrNrcFile)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($SamaFileOrNrcFile->SaMa_or_NRC) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($SamaFileOrNrcFile->SaMa_or_NRC) }}" height="150"
                width="250" style="padding: 5px">
            @endforeach
            @endif

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