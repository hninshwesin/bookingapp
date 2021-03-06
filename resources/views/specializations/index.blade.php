@extends('layouts.app')


@section('content')

    <div class="row" style="padding: 20px">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Specialization List</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('specialization.create') }}">Add Specialization</a>

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

            <th width="280px">Action</th>

        </tr>

        @foreach ($specializations as $specialization)

            <tr>

                <td>{{ $specialization->id }}</td>

                <td>{{ $specialization->name }}</td>

                <td>

{{--                    <form action="{{ route('specialization.destroy',$specialization->id) }}" method="POST">--}}



{{--                        <a class="btn btn-info" href="{{ route('specialization.show',$specialization->id) }}">Show</a>--}}



                        <a class="btn btn-primary" href="{{ route('specialization.edit',$specialization->id) }}">Edit</a>



{{--                        @csrf--}}

{{--                        @method('DELETE')--}}



{{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}

{{--                    </form>--}}

                </td>

            </tr>

        @endforeach


    </table>



    {{--    {!! $patients->links() !!}--}}

@endsection
