@extends('layouts.app')

@section('content')

{{-- <div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('terms_of_reference.create') }}"> Create Terms Of Reference </a>

</div>

</div>

</div> --}}


<div class="container col-md-12">
    <div class="form-row" style="padding: 20px">
        <div class="form-group col-md-6">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <a class="btn btn-outline-success my-2 my-sm-0" type="submit"
                        href="{{ route('terms_of_reference.create') }}">Create Terms Of Reference</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Content for Terms Of Reference</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @foreach ($termsOfReference as $termsOfReference)
                        <div class="card-header">{{ $termsOfReference->heading }}</div>

                        <div class="card-body">
                            {{ $termsOfReference->body }}
                        </div>
                        @endforeach
                    </div>

                    <div>
                        <a class="btn btn-primary" type="submit"
                            href="{{ route('terms_of_reference.edit', $termsOfReference->id) }}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection