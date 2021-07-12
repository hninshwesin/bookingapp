@extends('layouts.app')


@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Password Reset Form</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('doctor.index') }}"> Back</a>

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



<form action="{{ url('resetpassword') }}" method="POST">

    @csrf

    <div class="row" style="padding: 20px">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>App Login User Name:</strong>

                {{ $app_user->name }}

            </div>

        </div>

        <input type="hidden" value="{{ $app_user->id }}" name="app_user_id">

        <div class="col-xs-12 text-center">

            <div class="form-group">

                <strong>Please Type New Password:</strong>

                <input type="password" class="form-control" name="password" placeholder="Password" required
                    minlength="5">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>


    </div>



</form>

@endsection