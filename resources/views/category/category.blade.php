@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-7">
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <div class="card-body">
                        @if ($cats->count() == 0)
                            <div class="d-flex justify-content-center">
                                Categories empty. Please navigate to right section to add categories.
                            </div>
                        @else
                            <table class="table">
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td style="width:25%">Act</td>
                                </tr>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="d-flex flex-row gap-2">

                                                <a class="btn btn-primary"
                                                    onclick="displayEdit('{{ route('category.update', $cat->id) }}','{{ route('category.store') }}','{{ $cat->id }}')">Edit</a>
                                                <form action="{{ route('category.destroy', $cat->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="sticky-top" id="right-card" style="top: 2rem !important; z-index: 1;">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-head d-flex justify-content-between">
                                <span>Category New</span>

                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form-category" action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control mb-2 ep-form-control" autofocus>
                                @error('name')
                                    <p class="text-danger m-0" id="error-message">{{ $message }}</p>
                                @enderror

                                <button id="form-category-submit" class="btn btn-success mt-2"
                                    type="submit">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div>
            
            
        </div>
    </div>
    <script>
        function displayEdit(url, revertURL, id) {
            console.log(url);
            $('.card-head').html(`
                <span>Edit Category</span>
                <span onclick="revertEdit('${revertURL}')" class="text-primary" style="cursor: pointer">Back to create</span>

            `);
            $('#form-category-submit').html('Edit');
            $.get("category/" + id + '/edit',
                function(data) {
                    $('#name').val(data.name);
                    $('#form-category').attr('action', url).append('<input type="hidden" name="_method" value="PUT">');
                    $('#name').focus();
                    $('#error-message').remove();
                },
            );
        }

        const val = 123;
        console.log(val);

        function revertEdit(url) {
            $('.card-head').html(`
                <span>Create New Category</span>

            `);
            $('#form-category-submit').html('Create');
            $('#name').val('');
            $('#form-category').attr('action', url);
            $('input[name="_method"]').attr('value', '');
            $('#error-message').remove();
        }
    </script>
    @if ($errors->first('id'))
        <p>hi</p>
    @endif
@endsection
