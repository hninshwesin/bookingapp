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

            <h2>Doctors Profile</h2>

        </div>

        <div class="form-group col-md-6">

            <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

        </div>

        <!-- <div class="pull-right">
    
                    <a class="btn btn-success" href="{{ route('doctor.create') }}"> Create Doctor Profile</a>
    
                </div> -->

    </div>

    <table class="table table-bordered" id="doctors">

        <thead>
            <tr>

                <th>No</th>

                <th>Doctor Name</th>

                <th>Sama No.</th>

                <th>Qualifications</th>

                <th>Specialization</th>

                <th>Contact_Number</th>

                <th>Email</th>

                <th>App User Name</th>

                <th style="width:280px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($doctors as $doctor)

            <tr>

                <td>{{ $doctor->id }}</td>

                <td>{{ $doctor->Name }}</td>

                <td>{{ $doctor->sama_number }}</td>

                <td>{{ $doctor->Qualifications }}</td>

                <td>{{ $doctor->specialization }}</td>

                <td>{{ $doctor->Contact_Number }}</td>

                <td>{{ $doctor->Email }}</td>

                <td>{{ $doctor->app_user->name }}</td>

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
        </tbody>

    </table>
</div>

{{-- {!! $doctors->links() !!}--}}

@endsection

@section('scripts')

<script>
    $(function () {

$('#doctors').DataTable({

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