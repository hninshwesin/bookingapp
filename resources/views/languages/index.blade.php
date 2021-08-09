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

            <h2>Language Lists</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('language.create') }}"> Create Language </a>

        </div>

    </div>

    <table class="table table-bordered" id="languages">

        <thead>
            <tr>

                <th>No</th>

                <th>Language</th>

                <th style="width:280px">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($languages as $language)

            <tr>

                <td>{{ $language->id }}</td>

                <td>{{ $language->language }}</td>

                <td>

                    <form action="{{ route('language.destroy',$language->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('language.edit',$language->id) }}">Edit</a>

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

@endsection

@section('scripts')

<script>
    $(function () {

$('#languages').DataTable({

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