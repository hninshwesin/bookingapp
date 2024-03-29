@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            <h2>{{ $clinic->name }}</h2>
            @if($clinic->profile_image != 'null')
            <img src="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}" height="150" width="250">

            @endif
            {{-- <img src="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}"
            class="img" alt="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}"> --}}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Charity Service:</strong>

            {{ $clinic->charity_service }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Address:</strong>

            {{ $clinic->address }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contact_Number:</strong>

            {{ $clinic->contact_number }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {{ $clinic->email }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Available Time:</strong>

            {{ $clinic->available_time }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Region:</strong>

            @if ($clinic->region)
            {{$clinic->region->region }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Township:</strong>

            @if ($clinic->township)
            {{$clinic->township->township }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Comment:</strong>

            {{ $clinic->comment }}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('clinic.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection