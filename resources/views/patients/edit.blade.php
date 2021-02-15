@extends('layouts.app')


@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Patient Info</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('patient.index') }}"> Back</a>

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



    <form action="{{ route('patient.update',$patient->id) }}" method="POST">

        @csrf

        @method('PUT')



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <textarea class="form-control" name="Name" placeholder="Name">{{ $patient->Name }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Age:</strong>

                    <textarea class="form-control"name="Age" placeholder="Age">{{ $patient->Age }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Gender:</strong>

                    <textarea class="form-control" name="Gender" placeholder="Gender">{{ $patient->Gender }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Address:</strong>

                    <textarea class="form-control" style="height:150px" name="Address" placeholder="Address">{{ $patient->Address }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Contact_Number:</strong>

                    <textarea class="form-control" name="Contact_Number" placeholder="Contact_Number">{{ $patient->Contact_Number }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>



    </form>

@endsection
