@extends('layouts.app')


@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Help Feature</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('help.index') }}"> Back</a>

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



<form action="{{ route('help.update',$help->id) }}" method="POST">

    @csrf

    @method('PUT')

    <div class="row" style="padding: 0 20px">

        <div class="col-xs-12 col-sm-12 col-md-8">

            <div class="form-group">

                <strong>Heading:</strong>

                <textarea class="form-control" name="heading"
                    placeholder="Update Heading">{{ $help->heading }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

            <div class="form-group">

                <strong>Body:</strong>

                <textarea class="form-control" name="body" placeholder="Update Body">{{ $help->body }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>



</form>

@endsection