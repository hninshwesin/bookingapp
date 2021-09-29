@extends('layouts.app')


@section('content')

<div class="row" style="padding: 20px">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Terms Of Reference</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('terms_of_reference.index') }}"> Back</a>

        </div>

    </div>

</div>



@if ($errors->any())

<div class="alert alert-danger">

    <strong>Whoops!</strong> There were some problems with your input.<br><br>

    <ul>

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif



<form action="{{ route('terms_of_reference.update',$termsOfReference->id) }}" method="POST">

    @csrf

    @method('PUT')

    <div class="row" style="padding: 0 20px">

        <div class="col-xs-12 col-sm-12 col-md-8">

            <div class="form-group">

                <strong>Heading:</strong>

                <textarea class="form-control tinymce-editor" name="heading"
                    placeholder="Update Heading">{{ $termsOfReference->heading }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

            <div class="form-group">

                <strong>Body:</strong>

                <textarea class="form-control tinymce-editor" name="body"
                    placeholder="Update Body">{{ $termsOfReference->body }}</textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

</form>

@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
</script>

@endsection