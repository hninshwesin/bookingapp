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

            <h2>FAQ Lists</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('faq.create') }}"> Create New FAQ </a>

        </div>

    </div>

    <br>

    <div class="form-group col-md-6">

        <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>

    </div>

    <table class="table table-bordered" id="faq">

        <thead>
            <tr>

                <th>No</th>

                <th>Heading</th>

                <th>Body</th>

                <th style="width:280px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($faqs as $faq)

            <tr>

                <td>{{ $faq->id }}</td>

                <td>{!! $faq->question !!}</td>

                <td>{!! $faq->answer !!}</td>

                <td>

                    <form action="{{ route('faq.destroy',$faq->id) }}" method="POST">



                        <a class="btn btn-info" href="{{ route('faq.show',$faq->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('faq.edit',$faq->id) }}">Edit</a>



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

$('#faq').DataTable({

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