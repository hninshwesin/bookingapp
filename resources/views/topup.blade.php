@extends('layouts.app')

@section('content')


@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif

<div class="container-fluid" style="padding: 20px">

    <div class="form-group col-md-6">

        <a class="btn btn-success" href="approve_topup">Approve Requested Top up <i
                class="nav-icon fas fa-arrow-right"></i></a>

    </div>

    <div class="card card-default" style="display: flex; margin: 20px 0">
        <div class="card-header">
            <h3 class="text0 text-bold">Top Up for Patient</h3>
        </div>

        <div class="card-body" style="display: block">
            <form method="POST" action="{{ route('topup_patient.store') }}">
                @csrf

                <div class="form-group col-md-6">

                    <strong>Patient Name:</strong>

                    <select class="form-control" name="patient_id">
                        <option value="">--Select--</option>
                        @foreach( $patients as $patient)
                        <option value="{{ $patient->id }}">{{$patient->Name}} ( Current Balance -
                            {{$patient->wallet}} )</option>

                        @endforeach
                    </select>

                </div>

                <div class="form-group col-md-6">

                    <strong>Top up Amount:</strong>

                    <input type="text" name="amount" class="form-control" placeholder="input amount" required>

                </div>

                <div class="form-group col-md-6">
                    <button class="btn btn-outline-success " type="submit" value="submit">Submit</button>
                </div>

            </form>

            <div class="form-group col-md-6">

                <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

            </div>

        </div>
    </div>

    <div class="card card-default" style="display: flex; margin: 20px 0">
        <div class="card-header">
            <h3 class="text0 text-bold">Patient Top Up History</h3>
        </div>
        <div class="card-body" style="display: block">
            <table class="table table-bordered" id="topup_patients">

                <thead>
                    <tr>

                        <th>No</th>

                        {{-- <th>Admin Name</th> --}}

                        <th>Patient Name</th>

                        <th>Top Up Amount</th>

                        <th>Date</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($topup_patients as $topup_patient)

                    <tr>

                        <td>{{ $topup_patient->id }}</td>

                        {{-- <td>{{ $topup_patient->user->name }}</td> --}}

                        <td>{{ $topup_patient->patient->Name }}</td>

                        <td>{{ $topup_patient->amount }}</td>

                        <td>{{ $topup_patient->created_at }}</td>

                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


</div>

{{-- {!! $doctors->links() !!}--}}

@endsection

@section('scripts')

<script>
    $(function () {

$('#topup_patients').DataTable({

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