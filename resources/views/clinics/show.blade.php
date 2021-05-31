@extends('layouts.app')
@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

                <h2>{{ $clinic->name }}</h2>
                @if($clinic->profile_image != 'null')
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}"
                         class="img"
                         alt="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}">

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
