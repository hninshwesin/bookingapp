@extends('layouts.app')

@section('content')

{{-- <div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Ambulance Lists</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('ambulance.create') }}"> Create Ambulance </a>

</div>

</div>

</div> --}}

@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif


<div style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Ambulance Lists</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('ambulance.create') }}"> Create Ambulance </a>

        </div>

    </div>

    <table class="table table-bordered" id="ambulances">

        <thead>
            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Charity Service</th>

                <th>Address</th>

                <th>Contact_Number</th>

                <th>Email</th>

                <th style="width:250px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($ambulances as $ambulance)

            <tr>

                <td>{{ $ambulance->id }}</td>

                <td>{{ $ambulance->name }}</td>

                <td>{{ $ambulance->charity_service }}</td>

                <td>{{ $ambulance->address }}</td>

                <td>{{ $ambulance->contact_number }}</td>

                <td>{{ $ambulance->email }}</td>

                <td>

                    <form action="{{ route('ambulance.destroy',$ambulance->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('ambulance.show',$ambulance->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('ambulance.edit',$ambulance->id) }}">Edit</a>



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


{{-- {!! $ambulances->links() !!} --}}



@endsection

@section('scripts')

<script>
    $(function () {

$('#ambulances').DataTable({

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