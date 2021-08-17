@extends('layouts.app')


@section('content')


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

<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add Cover Image for Slide Show</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('cover_image.index') }}"> Back</a>

        </div>

    </div>
    <br>

    <form action="{{ route('cover_image.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Please upload your Image:</strong>

                    <input type="file" multiple="multiple" name="images[]" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>



    </form>

</div>




@endsection