@extends('layouts.front')

@section('content')
    
    <div class="row front">

        <div class="col-sm-12">
            <h2 class="display-5 alert alert-dark">
                {{ $category->name }}
            </h2>

            <hr>
        </div>

        @if ($category->products->count())
            @foreach ($category->products as $key => $product)
                
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
        @else
            <div class="col-sm-12">
                <h2 class="alert alert-warning">
                    Nenhum produto encontrado para esta categoria.
                </h2>
            </div>
        @endif
        
    </div>

@endsection