@extends('layouts.app')

@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Lab Pending List</h2>

            </div>

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

        @foreach ($labs as $lab)

            <tr>

                <td>{{ $lab->id }}</td>

                <td>{{ $lab->name }}</td>

                <td>{{ $lab->charity_service }}</td>

                <td>{{ $lab->address }}</td>

                <td>{{ $lab->contact_number }}</td>

                <td>{{ $lab->email }}</td>

                <td>{{ $lab->available_time }}</td>

                <td>

                    <form action="{{ route('lab_approve') }}" method="POST">
                    @csrf

                        <input type="number" class="form-control" value="{{$lab->id}}" name="lab_id" hidden>

                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Approve</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>


@endsection
