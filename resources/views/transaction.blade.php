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
                                            <a href="{{ route('transaction.add-item', $item->id) }}"
                                                class="btn btn-primary {{(in_array($item->id, $ids)) ? 'disabled' : ''}}">Add</a>
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
                            {{-- @dd($cart) --}}
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td><input type="number" name="qty" id="qty" class="form-control" value="{{($item->stock > 0) ? 1 : 0}}" min="0" max="{{$item->stock}}"></td>
                                    <td>
                                        <a href="{{route('transaction.remove-item', $item->id)}}" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="row mb-2">
                            <div class="col-md-4 d-flex align-items-center">
                                <label for="grand" class="form-label m-0">Grand Total</label>
                            </div>
                            <div class="col-md-8 d-flex flex-row align-items-center gap-2">
                                <span>:</span>
                                <input type="text" class="form-control">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('transaction.check') }}" class="btn btn-primary">Check</a>
    <a href="{{ route('transaction.flush') }}" class="btn btn-danger">Flush</a>
    {{-- @dd(Session::get('user')) --}}
@endsection
