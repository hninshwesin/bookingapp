@extends('layouts.app')



@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Doctors Profile</h2>

        </div>

        <!-- <div class="pull-right">

                <a class="btn btn-success" href="{{ route('doctor.create') }}"> Create Doctor Profile</a>

            </div> -->

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

            <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">



                <a class="btn btn-info" href="{{ route('doctor.show',$doctor->id) }}">Show</a>


                <a class="btn btn-primary" href="{{ route('doctor.edit',$doctor->id) }}">Edit</a>


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