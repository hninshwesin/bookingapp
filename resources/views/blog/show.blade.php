@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            <h2>{!! $blog->heading !!}</h2>
            @if($blog->image != 'null')
            <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($blog->image) }}" height="150" width="250">

            @endif
            {{-- <img src="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}" class="img"
                alt="{{ \Illuminate\Support\Facades\Storage::url($clinic->profile_image) }}"> --}}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Heading:</strong>

            {!! $blog->heading !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Body:</strong>

            {!! $blog->body !!}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('blog.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection