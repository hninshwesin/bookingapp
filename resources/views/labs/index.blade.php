@extends('layouts.app')



@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Lab Lists</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('lab.create') }}"> Create Lab </a>

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

                <td>

                    <form action="{{ route('lab.destroy',$lab->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('lab.show',$lab->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('lab.edit',$lab->id) }}">Edit</a>



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
