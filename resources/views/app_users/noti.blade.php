@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))

<div class="alert alert-success">

    <p>{{ $message }}</p>

</div>

@endif

<div class="container col-md-12">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Content for All App User Noi through App</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">App User: <strong>{{ $app_users->count() }}</strong> person</div>

                        <div class="card-body">
                            <form action="{{ route('app_user_noti') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-xs-8 col-sm-8 col-md-8">

                                        <div class="form-group">

                                            <strong>Heading:</strong>

                                            <input type="text" name="heading" class="form-control"
                                                placeholder="Heading">

                                        </div>

                                    </div>

                                    <div class="col-xs-8 col-sm-8 col-md-8">

                                        <div class="form-group">

                                            <strong>Body:</strong>

                                            {{-- <input type="text" name="body" class="form-control" placeholder="Body"
                                                required> --}}

                                            <textarea class="form-control" name="body" placeholder="Body"></textarea>

                                        </div>

                                    </div>

                                    <div class="col-xs-8 col-sm-8 col-md-8 text-center">

                                        <button type="submit" class="btn btn-primary">Send</button>

                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
</div>

@endsection