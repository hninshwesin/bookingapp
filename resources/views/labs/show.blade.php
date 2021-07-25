@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            <h2>{{ $lab->name }}</h2>
            @if($lab->profile_image != 'null')
            <img src="{{ \Illuminate\Support\Facades\Storage::url($lab->profile_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($lab->profile_image) }}" height="150" width="250">

            @endif
            {{-- <img src="{{ \Illuminate\Support\Facades\Storage::url($lab->profile_image) }}"
            class="img" alt="{{ \Illuminate\Support\Facades\Storage::url($lab->profile_image) }}"> --}}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Charity Service:</strong>

            {{ $lab->charity_service }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Address:</strong>

            {{ $lab->address }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contact_Number:</strong>

            {{ $lab->contact_number }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {{ $lab->email }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Available Time:</strong>

            {{ $lab->available_time }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Region:</strong>

            @if ($lab->region)
            {{$lab->region->region }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Township:</strong>

            @if ($lab->township)
            {{$lab->township->township }}
            @endif

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Comment:</strong>

            {{ $lab->comment }}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('lab.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection