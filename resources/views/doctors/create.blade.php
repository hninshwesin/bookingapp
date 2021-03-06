@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Add Doctor Profile</h2>

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



    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">

        @csrf



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <input type="text" name="Name" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>SAMA Number:</strong>

                    <input type="number" class="form-control" name="sama_number" placeholder="Sama Number">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Qualifications:</strong>

                    <textarea class="form-control" name="Qualifications" placeholder="Qualifications"></textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Contact Number:</strong>

                    <input type="number" class="form-control" name="Contact_Number" placeholder="Contact Number">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Email:</strong>

                    <textarea class="form-control" name="Email" placeholder="Email"></textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Password:</strong>

                    <input type="password" name="password" class="form-control" placeholder="Password">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Other Options:</strong>

                    <textarea class="form-control" name="other_option" placeholder="Write down your options"></textarea>

                </div>

            </div>

{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}

{{--                <div class="form-group">--}}

{{--                    <strong>File Name:</strong>--}}

{{--                    <input type="text" name="file_name" class="form-control" placeholder="Please fill image file name">--}}

{{--                </div>--}}

{{--            </div>--}}

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Please upload your SAMA registration card or NRC card (can attach more than one):</strong>

                    <input type="file" multiple="multiple" name="SaMa_or_NRC[]" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Please upload your real Profile Image:</strong>

                    <input type="file" name="profile_image[]" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Please upload other Certificate File (can attach more than one):</strong>

                    <input type="file" multiple="multiple" name="certificate_file[]" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>



    </form>

@endsection
