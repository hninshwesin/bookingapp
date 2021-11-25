@extends('layouts.app')

@section('content')


@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif

<div class="container-fluid" style="padding: 20px">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-wallet float-right" style="font-size: 50px"></i>
                    </div>
                    <div class="mr-5" style="font-size: 30px">My Wallet!</div>
                    <span style="font-size: 30px;color: yellow">{{ $user->wallet }}<sup style="font-size: 15px">
                            MMK</sup></span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

    </div>

    <div class="card card-default" style="display: flex; margin: 20px 0">
        <div class="card-header">
            <h3 class="text0 text-bold">Wallet History</h3>

        </div>
        <div class="card-body" style="display: block">
            <table class="table table-bordered" id="transactions">

                <thead>
                    <tr>

                        <th>No</th>

                        <th>Patient</th>

                        <th>Doctor</th>

                        <th>Total Amount</th>

                        <th>To Doctor Amount</th>

                        <th>My Amount</th>

                        <th>Date</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($transactions as $transaction)

                    <tr>

                        <td>{{ $transaction->id }}</td>

                        <td>{{ $transaction->app_user_patient->name }}</td>

                        <td>{{ $transaction->app_user_doctor->name }}</td>

                        <td>{{ $transaction->total_amount }}</td>

                        <td>{{ $transaction->to_doctor_amount }}</td>

                        <td>{{ $transaction->to_admin_amount }}</td>

                        <td>{{ $transaction->created_at }}</td>

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

$('#transactions').DataTable({

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