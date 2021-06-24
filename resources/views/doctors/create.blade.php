<!-- @extends('layouts.app')

@section('scripts')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>


        <script type="text/javascript">

        $(function () {
            $('.timepicker').datetimepicker({

                format: 'HH:mm:ss'

            });
        });

    </script>

@endsection



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

                    <strong>Specialization:</strong>

                    <select class="form-control" name="specialization">
                        <option value="">--Select--</option>
                        @foreach( $specializations as $specialization)
                            <option value="{{ $specialization->name }}">{{$specialization->name}}</option>
                        @endforeach
                    </select>

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

                    <strong>Available Time:</strong>

                    <input type="text" class="form-control" name="available_time" placeholder="available time">

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

                    <input type="file" name="profile_image" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Please upload other Certificate File (can attach more than one):</strong>

                    <input type="file" multiple="multiple" name="certificate_file[]" class="form-control">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Hide my information for safety:</strong><br>

                    <input type="radio" name="hide_my_info" value="Yes">
                    <label for="Yes">Yes</label><br>
                    <input type="radio" name="hide_my_info" value="No">
                    <label for="No">No</label><br>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>

    </form>

@endsection -->