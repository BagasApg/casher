@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
                    <div class="card-body">
                        @if ($items->count() == 0)
                            <div class="d-flex justify-content-center">

                                Items empty. Please navigate to right section to add items.
                            </div>
                        @else
                            <table class="table">
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Category</td>
                                    <td>Stock</td>
                                    <td>Price</td>
                                    <td style="width:25%">Act</td>
                                </tr>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->stock}}</td>
                                        <td>@currency($item->price)</td>
                                        <td class="d-flex gap-2">
                                            <a onclick="displayEdit({{$item->id}})" class="btn btn-primary">Edit</a>
                                            <form action="{{route('item.destroy', $item->id)}}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card sticky-top" style="top: 2rem; z-index: 1;">
                    <div class="card-header">
                        Add New Item
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item.store') }}" method="POST">
                            @csrf

                            <label for="name" class="form-label">Item Name</label>
                            <input type="text" name="name" class="form-control mb-2 ep-form-control" autofocus>

                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-control mb-2 ep-form-control">
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control mb-2 ep-form-control">

                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control mb-3 ep-form-control">

                            <button class="btn btn-success" type="submit">Add</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function displayEdit(id){
            $.get("item/" + id + "/edit",
                function (data) {
                    console.log(data)
                    $('input[name="name"]').val(data.name);
                    $('select[name="category"]').val(data.category_id);
                    $('input[name="price"]').val(data.price);
                    $('input[name="stock"]').val(data.stock);
                }
            );
        }
    </script>
    
@endsection
