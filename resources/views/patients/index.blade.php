@extends('layouts.app')


@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Patients Information</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('patient.create') }}">Add Patient Information</a>

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

            <th>Age</th>

            <th>Gender</th>

            <th>Address</th>

            <th>Contact_Number</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($patients as $patient)

            <tr>

                <td>{{ $patient->id }}</td>

                <td>{{ $patient->Name }}</td>

                <td>{{ $patient->Age }}</td>

                <td>{{ $patient->Gender }}</td>

                <td>{{ $patient->Address }}</td>

                <td>{{ $patient->Contact_Number }}</td>

                <td>

                    <form action="{{ route('patient.destroy',$patient->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('patient.show',$patient->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('patient.edit',$patient->id) }}">Edit</a>



                        @csrf

                        @method('DELETE')



                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>



    {{--    {!! $doctors->links() !!}--}}

@endsection
