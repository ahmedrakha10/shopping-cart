@extends('layouts.app')

@section('content')
    <div class="container">

        <section>
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mt-2">
                        <div class="card">
                            <img src="{{$product->image}}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <p>${{$product->price}}</p>
                                <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
