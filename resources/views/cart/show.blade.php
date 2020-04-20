@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($cart)
                <div class="col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach($cart->items as $item)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$item['title']}}
                                </h5>
                                <div class="card-text">
                                    <p style="margin-bottom: -24px">${{$item['price']}}</p>


                                    {{--<a href="#" class="btn btn-secondary btn-sm">change</a>--}}
                                    <form action="{{route('qty.update',$item['id'])}}" method="post"
                                          style="margin-left: 60px;">
                                        @csrf
                                        @method('put')
                                        <input type="text" name="qty" id="qty" value="{{$item['qty']}}"/>
                                        <button class="btn btn-primary btn-sm">
                                            change
                                        </button>
                                    </form>

                                    <form action="{{route('cart.remove',$item['id'])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm ml-4"
                                                style="float: right;margin-top: -30px;">Remove
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <p><strong>Total Price is : ${{$cart->totalPrice}}</strong></p>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3 class="card-title">
                                Your Cart
                                <hr/>
                            </h3>
                            <div class="card-text">
                                <p>Total Amount : ${{$cart->totalPrice}}</p>
                                <p>Total quantities : {{$cart->totalQty}}</p>
                                <a href="{{route('cart.checkout',$cart->totalPrice)}}" class="btn btn-info">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p><strong>there are no products in the cart</strong></p>
            @endif
        </div>
    </div>
@endsection
