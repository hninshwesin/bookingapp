@extends('layouts.app')
@section('content')

<div class="row" style="padding: 20px">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Question:</strong>

            {!! $faq->question !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Answer:</strong>

            {!! $faq->answer !!}

        </div>

    </div>

</div>

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('faq.index') }}"> Back</a>

        </div>

    </div>

</div>

@endsection