@extends('layouts.app')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New FAQ</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('faq.index') }}"> Back</a>

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



<form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">

    @csrf



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Question:</strong>

                <input type="text" name="question" class="form-control tinymce-editor" placeholder="Question">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Answer:</strong>

                <textarea class="form-control tinymce-editor" style="height:150px" name="answer"
                    placeholder="Answer"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>



</form>

@endsection

@section('third_party_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $("#region").change(function () {
if ($(this).data('options') == undefined) {
$(this).data('options', $('#township option').clone());
}
var id = $(this).val();
if (id == " ") {
var options = $(this).data('options');
$('#township').html(options);
}
else {
var options = $(this).data('options').filter('[data-name=' + id + ']');
$('#township').html(options);
}
});
</script>

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