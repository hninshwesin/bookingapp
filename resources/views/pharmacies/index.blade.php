@extends('layouts.app')



@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Pharmacy Lists</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('pharmacy.create') }}"> Create Pharmacy </a>

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

        @foreach ($pharmacies as $pharmacy)

            <tr>

                <td>{{ $pharmacy->id }}</td>

                <td>{{ $pharmacy->name }}</td>

                <td>{{ $pharmacy->charity_service }}</td>

                <td>{{ $pharmacy->address }}</td>

                <td>{{ $pharmacy->contact_number }}</td>

                <td>{{ $pharmacy->email }}</td>

                <td>

                    <form action="{{ route('pharmacy.destroy',$pharmacy->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('pharmacy.show',$pharmacy->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('pharmacy.edit',$pharmacy->id) }}">Edit</a>



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
