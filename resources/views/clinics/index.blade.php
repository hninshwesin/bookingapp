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

            <h2>Clinic Lists</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('clinic.create') }}"> Create Clinic </a>

        </div>

    </div>
    <table class="table table-bordered" id="clinics">

        <thead>
            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Charity Service</th>

                <th>Address</th>

                <th>Contact_Number</th>

                <th>Email</th>

                <th style="width:280px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($clinics as $clinic)

            <tr>

                <td>{{ $clinic->id }}</td>

                <td>{{ $clinic->name }}</td>

                <td>{{ $clinic->charity_service }}</td>

                <td>{{ $clinic->address }}</td>

                <td>{{ $clinic->contact_number }}</td>

                <td>{{ $clinic->email }}</td>

                <td>

                    <form action="{{ route('clinic.destroy',$clinic->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('clinic.show',$clinic->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('clinic.edit',$clinic->id) }}">Edit</a>



                        @csrf

                        @method('DELETE')



                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>

                </td>

            </tr>

            @endforeach
        </tbody>

    </table>
</div>

{{--    {!! $doctors->links() !!}--}}

@endsection

@section('scripts')

<script>
    $(function () {

$('#clinics').DataTable({

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