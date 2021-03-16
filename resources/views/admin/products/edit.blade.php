@extends('layouts.app')

@section('content')
<form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome do Produto</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" class="form-control" value="{{ $product->name }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição do Produto</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $product->description }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="body">Conteúdo</label>
        <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="3">{{ $product->body }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Preço</label>
        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}">
        @error('price')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="categories">Categorias</label>
        <select name="categories[]" id="categories" class="form-control" multiple>
            @if(count($categories))
                @foreach($categories as $category)                    
                    <option value="{{ $category->id }}" @if($product->categories->contains($category)) selected @endif>{{ $category->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="photos">Fotos do produto</label>
        <input type="file" class="form-control @error('photos.*') is-invalid @enderror" id="photos" name="photos[]" multiple>

        @error('photos.*')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>

<hr>

<div class="row">
    <div class="container">

        <div class="row">
            @foreach ($product->photos as $photo)
                <div class="col-sm-4 text-center">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">

                    <form action="{{ route('admin.photo.remove') }}" method="post">
                        @csrf
                        
                        <input type="hidden" name="photoName" value="{{ $photo->image }}">

                        <button type="submit" class="btn btn-danger btn-lg">Remover</button>
                    </form>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection