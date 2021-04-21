@extends('layouts.app')

@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Doctor Pending List</h2>

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

            <th>Sama No.</th>

            <th>Qualifications</th>

            <th>Specialization</th>

            <th>Contact_Number</th>

            <th>Email</th>

            <th style="width:280px">Action</th>

        </tr>

        @foreach ($doctors as $doctor)

            <tr>

                <td>{{ $doctor->id }}</td>

                <td>{{ $doctor->Name }}</td>

                <td>{{ $doctor->sama_number }}</td>

                <td>{{ $doctor->Qualifications }}</td>

                <td>{{ $doctor->specialization }}</td>

                <td>{{ $doctor->Contact_Number }}</td>

                <td>{{ $doctor->Email }}</td>

                <td>

                    <form action="{{ route('doctor_approve') }}" method="POST">
                    @csrf

                        <input type="number" class="form-control" value="{{$doctor->id}}" name="doctor_id" hidden>

                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="submit">Approve</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>


{{--    {!! $doctors->links() !!}--}}



@endsection
