@extends('layouts.app')


@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Pharmacy Info</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('pharmacy.index') }}"> Back</a>

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



<form action="{{ route('pharmacy.update',$pharmacy->id) }}" method="POST" enctype="multipart/form-data">

    @csrf

    @method('PUT')

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                <textarea class="form-control" name="name" placeholder="Name">{{ $pharmacy->name }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Address:</strong>

                <textarea class="form-control" style="height:150px" name="address"
                    placeholder="Address">{{ $pharmacy->address }}</textarea>

            </div>

        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Contact Number:</strong>

                <input class="form-control" name="contact_number" placeholder="Contact Number"
                    value="{{ $pharmacy->contact_number }}">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                <textarea class="form-control" name="email" placeholder="email">{{ $pharmacy->email }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Available Time:</strong>

                <textarea class="form-control" name="available_time"
                    placeholder="$pharmacy->available_time">{{ $pharmacy->available_time }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Region:</strong>

                @if ($pharmacy->region)

                <select class="form-control" name="region_id">
                    <option value="">--Select--</option>
                    @foreach( $regions as $region)
                    <option value="{{ $region->id }}"
                        {{ ($pharmacy->region->region) == $region->region ? 'selected' : '' }}>
                        {{$region->region}}</option>
                    @endforeach
                </select>

                @else

                <select class="form-control" name="region_id">
                    <option value="">--Select--</option>
                    @foreach( $regions as $region)
                    <option value="{{ $region->id }}">{{$region->region}}</option>
                    @endforeach
                </select>

                @endif
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Township:</strong>

                @if ($pharmacy->township)

                <select class="form-control" name="township_id">
                    <option value="">--Select--</option>
                    @foreach( $townships as $township)
                    <option value="{{ $township->id }}"
                        {{ ($pharmacy->township->township) == $township->township ? 'selected' : '' }}>
                        {{$township->township}}
                    </option>
                    @endforeach
                </select>

                @else

                <select class="form-control" name="township_id">
                    <option value="">--Select--</option>
                    @foreach( $townships as $township)
                    <option value="{{ $township->id }}">{{$township->township}}</option>
                    @endforeach
                </select>

                @endif

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Comment:</strong>

                <textarea class="form-control" name="comment"
                    placeholder="Write down your comment">{{ $pharmacy->comment }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Please upload your Profile Image:</strong>

                <input type="file" name="profile_image" class="form-control">

            </div>

        </div>

        <div class="col-md-3">
            @if($pharmacy->profile_image != 'null')
            <img src="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($pharmacy->profile_image) }}" height="150" width="250">
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>



</form>

@endsection