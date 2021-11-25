@extends('layouts.app')

@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Patient Top up Pending List</h2>

        </div>

    </div>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ url('topup_patient') }}"> Back to Top up History</a>

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

        <th>Patient Name</th>

        <th>Phone Number</th>

        <th>Top Up Amount</th>

        <th>Date</th>

        <th style="width:280px">Action</th>

    </tr>

    @foreach ($topup_patients as $topup_patient)

    <tr>

        <td>{{ $topup_patient->id }}</td>

        <td>{{ $topup_patient->patient->Name }}</td>

        <td>{{ $topup_patient->patient->Contact_Number }}</td>

        <td>{{ $topup_patient->amount }}</td>

        <td>{{ $topup_patient->created_at }}</td>

        <td>

            <form action="{{ url('topup_approve') }}" method="POST">
                @csrf

                <input type="number" class="form-control" value="{{$topup_patient->id}}" name="topup_patient_id" hidden>

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Approve</button>

            </form>

        </td>

    </tr>

    @endforeach

</table>


{{-- {!! $doctors->links() !!}--}}



@endsection