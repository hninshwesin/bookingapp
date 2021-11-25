@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif


<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>App Cover Images</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('cover_image.create') }}"> Add Image </a>

        </div>

    </div>

    <br>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

    </div>

    <br>

    <table class="table table-bordered">

        <thead>
            <tr>

                <th>No</th>

                <th>Image</th>

                <th style="width:300px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($images as $image)

            <tr>

                <td>{{ $image->id }}</td>

                <td><img src="{{ \Illuminate\Support\Facades\Storage::url($image->cover_image) }}" class="img"
                        alt="{{ \Illuminate\Support\Facades\Storage::url($image->cover_image) }}" height="150"
                        width="250"></td>


                <td>

                    <form action="{{ route('cover_image.destroy',$image->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('cover_image.show',$image->id) }}">Show</a>

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

            @endforeach
        </tbody>

    </table>
</div>


@endsection