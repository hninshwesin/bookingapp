@extends('layouts.app')
@section('content')

<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        {{--            <img src="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}"--}}
        {{--                 class="img-circle elevation-2"--}}
        {{--                 alt="{{ \Illuminate\Support\Facades\Storage::url($doctor->DoctorCertificateFile[0]->certificate_file) }}">--}}

        <div class="pull-left">

            <img src="{{ \Illuminate\Support\Facades\Storage::url($cover_image->cover_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($cover_image->cover_image) }}" height="200"
                width="350">

        </div>

    </div>

</div>

<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('cover_image.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection