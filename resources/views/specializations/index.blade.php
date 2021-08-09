@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif

<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Specialization List</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('specialization.create') }}">Add Specialization</a>

        </div>

    </div>

    <table class="table table-bordered" id="specializations">

        <thead>
            <tr>

                <th>No</th>

                <th>Name</th>

                <th width="280px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($specializations as $specialization)

            <tr>

                <td>{{ $specialization->id }}</td>

                <td>{{ $specialization->name }}</td>

                <td>

                    {{--                    <form action="{{ route('specialization.destroy',$specialization->id) }}"
                    method="POST">--}}



                    {{--                        <a class="btn btn-info" href="{{ route('specialization.show',$specialization->id) }}">Show</a>--}}



                    <a class="btn btn-primary" href="{{ route('specialization.edit',$specialization->id) }}">Edit</a>



                    {{--                        @csrf--}}

                    {{--                        @method('DELETE')--}}



                    {{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}

                    {{--                    </form>--}}

                </td>

            </tr>

            @endforeach
        </tbody>


    </table>

</div>

{{--    {!! $patients->links() !!}--}}

@endsection

@section('scripts')

<script>
    $(function () {

$('#specializations').DataTable({

"bPaginate": true,
"bLengthChange": false,
"bFilter": true,
"bInfo": true,
"bAutoWidth": false,
"searching": true,
"ordering": true,
"autoWidth": false,
"responsive": true,
});
});
</script>
@endsection