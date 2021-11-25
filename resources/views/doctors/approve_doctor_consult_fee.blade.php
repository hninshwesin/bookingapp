@extends('layouts.app')

@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Doctor Consultation Fee Request Pending List</h2>

        </div>

    </div>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ url('home') }}"> Back to Home</a>

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

        <th>Doctor Name</th>

        <th>Phone Number</th>

        <th>Withdraw Amount</th>

        <th>Date</th>

        <th style="width:280px">Action</th>

    </tr>

    @foreach ($withdraw_fees as $withdraw_fee)

    <tr>

        <td>{{ $withdraw_fee->id }}</td>

        <td>{{ $withdraw_fee->doctor->Name }}</td>

        <td>{{ $withdraw_fee->doctor->Contact_Number }}</td>

        <td>{{ $withdraw_fee->amount }}</td>

        <td>{{ $withdraw_fee->created_at }}</td>

        <td>

            <form action="{{ url('withdraw_approve') }}" method="POST">
                @csrf

                <input type="number" class="form-control" value="{{$withdraw_fee->id}}"
                    name="withdraw_consultation_fee_id" hidden>

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Approve</button>

            </form>

        </td>

    </tr>

    @endforeach

</table>


{{-- {!! $doctors->links() !!}--}}



@endsection