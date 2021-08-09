@extends('layouts.app')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add Oxygen Information</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('lab.index') }}"> Back</a>

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



<form action="{{ route('lab.store') }}" method="POST" enctype="multipart/form-data">

    @csrf



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                <input type="text" name="name" class="form-control" placeholder="Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Address:</strong>

                <textarea class="form-control" style="height:150px" name="address" placeholder="Address"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Contact_Number:</strong>

                <input type="number" class="form-control" name="contact_number" placeholder="Contact_Number">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                <textarea class="form-control" name="email" placeholder="Email"></textarea>

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

                <strong>Region:</strong>

                <select class="form-control" name="region_id" id="region">
                    <option value="">--Select--</option>
                    @foreach( $regions as $region)
                    <option value="{{ $region->id }}">{{$region->region}}</option>
                    @endforeach
                </select>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Township:</strong>

                <select class="form-control" name="township_id" id="township">
                    <option value="">--Select--</option>
                    @foreach( $townships as $township)
                    <option data-name="{{ $township->region_id }}" value="{{ $township->id }}">{{$township->township}}
                    </option>
                    @endforeach
                </select>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Comment:</strong>

                <textarea class="form-control" name="comment" placeholder="Write down your comments"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Please upload your Profile Image:</strong>

                <input type="file" name="profile_image" class="form-control">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>



</form>

@endsection

@section('third_party_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $("#region").change(function () {
if ($(this).data('options') == undefined) {
$(this).data('options', $('#township option').clone());
}
var id = $(this).val();
if (id == " ") {
var options = $(this).data('options');
$('#township').html(options);
}
else {
var options = $(this).data('options').filter('[data-name=' + id + ']');
$('#township').html(options);
}
});
</script>

@endsection