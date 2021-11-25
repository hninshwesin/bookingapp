@extends('layouts.app')

@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Pharmacy Pending List</h2>

        </div>

    </div>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

    </div>

</div>

@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif


<table class="table table-bordered">

    <tr>

        <th>No</th>

        <th>Name</th>

        <th>Charity Service</th>

        <th>Address</th>

        <th>Contact_Number</th>

        <th>Email</th>

        <th>Available Time</th>


        <th style="width:280px">Action</th>

    </tr>

    @foreach ($pharmacies as $pharmacy)

    <tr>

        <td>{{ $pharmacy->id }}</td>

        <td>{{ $pharmacy->name }}</td>

        <td>{{ $pharmacy->charity_service }}</td>

        <td>{{ $pharmacy->address }}</td>

        <td>{{ $pharmacy->contact_number }}</td>

        <td>{{ $pharmacy->email }}</td>

        <td>{{ $pharmacy->available_time }}</td>

        <td>

            <form action="{{ route('pharmacy_approve') }}" method="POST">
                @csrf

                <input type="number" class="form-control" value="{{$pharmacy->id}}" name="pharmacy_id" hidden>

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Approve</button>

            </form>

        </td>

    </tr>

    @endforeach

</table>


@endsection