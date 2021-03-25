@extends('layouts.front')

@section('content')
    
    <div class="row front">

        @foreach ($products as $key => $product)
            
            <div class="col-sm-4">
                <div class="card" style="width: 98%">
                    <div class="card-header">
                        @if($product->photos()->count())
                            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="card-img-top img-fluid">
                        @else
                            <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" class="card-img-top img-fluid">
                        @endif                
                    </div>

                    <div class="card-body">
                        <div class="card-title">{{ $product->name }}</div>
                        <div class="card-text">{{ $product->description }}</div>
                        
                        <p>R$ {{ number_format($product->price, 2, ',', '.') }}</p>

                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">
                            Ver produto
                        </a>
                    </div>

                </div>
            </div>
            @if(($key + 1) % 3 == 0)
                </div><div class="row front">
            @endif

        @endforeach
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="alert alert-dark" role="alert">
                Lojas em destaque
            </h4>
        </div>

        @foreach ($stores as $store)
            <div class="col-sm-4">
                @if ($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="img-fluid">
                @else
                    <img src="{{ asset('assets/img/loja-sem-logo.png') }}" alt="Loja sem logo" class="img-fluid">
                @endif

                <h3>{{ $store->name }}</h3>

                <p>
                    {{ $store->description }}
                </p>

                <a href="{{ route('store.single', ['slug' => $store->slug]) }}" class="btn btn-success">Visitar Loja</a>
            </div>
        @endforeach

    </div>

@endsection