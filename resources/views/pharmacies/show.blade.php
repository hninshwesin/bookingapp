@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            <h2>{{ $pharmacy->name }}</h2>
            @if($pharmacy->profile_image != 'null')
            <img src="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}" height="150" width="250">

            @endif
            {{-- <img src="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}"
            class="img" alt="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}"> --}}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Charity Service:</strong>

            {{ $pharmacy->charity_service }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Address:</strong>

            {{ $pharmacy->address }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contact_Number:</strong>

            {{ $pharmacy->contact_number }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {{ $pharmacy->email }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Available Time:</strong>

            {{ $pharmacy->available_time }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Region:</strong>

            @if ($pharmacy->region)
            {{$pharmacy->region->region }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Township:</strong>

            @if ($pharmacy->township)
            {{$pharmacy->township->township }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Comment:</strong>

            {{ $pharmacy->comment }}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('pharmacy.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection