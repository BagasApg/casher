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
                        <table class="table table-hover">
                            <thead>

                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Category</td>
                                    <td>Stock</td>
                                    <td>Price</td>
                                    <td style="width:10%">Act</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>@currency($item->price)</td>
                                        <td>
                                            <a href="{{ route('transaction.add', $item->id) }}"
                                                class="btn btn-primary">Add</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card sticky-top" style="top: 2rem">
                    <div class="card-header">
                        Cart
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td style="width: 15%">Qty.</td>
                                <td style="width: 15%"></td>
                            </tr>
                            @if (session('cart'))
                                @foreach (session()->get('cart') as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <form action="{{route('cart.update')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item['id']}}">
                                            <td>
                                                <input type="number" name="qty" id="qty" class="form-control"
                                                value="{{ $item['qty'] }}" onchange="update({{$loop->iteration}})">
                                            </td>
                                            <td>Rp.{{$item['subtotal']}}</td>
                                            <td>
                                                <input id="update{{$loop->iteration}}" value="Update" type="submit" style="display: none" class="btn btn-primary">
                                                <a id="delete{{$loop->iteration}}" href="{{route('cart.delete', $item['id'])}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                <script>
                                    function update(id){
                                        $("#update"+id).show();
                                        $("#delete"+id).hide();
                                    }
                                </script>
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Cart is empty!
                                    </td>
                                </tr>
                            @endif

                        </table>

                        <div class="row mb-2">
                            <div class="col-md-4 d-flex align-items-center">
                                <label for="grand" class="form-label m-0">Grand Total</label>
                            </div>
                            <div class="col-md-8 d-flex flex-row align-items-center gap-2">
                                <span>:</span>
                                <input type="text" class="form-control" value="{{session()->get('cart_subtotal')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center">
                                <label for="grand" class="form-label m-0">Payment</label>
                            </div>
                            <div class="col-md-8 d-flex flex-row align-items-center gap-2">
                                <span>:</span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <a href="{{ route('transaction.flush') }}" class="btn btn-warning">Flush</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
