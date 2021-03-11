@extends('layouts.app')

@section('content')
<form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome do Produto</label>
        <input type="text" class="form-control" name="name" id="name" class="form-control" value="{{ $product->name }}">
    </div>

    <div class="form-group">
        <label for="description">Descrição do Produto</label>
        <input type="text" name="description" id="description" class="form-control" value="{{ $product->description }}">
    </div>

    <div class="form-group">
        <label for="body">Conteúdo</label>
        <textarea name="body" id="body" class="form-control" rows="3">{{ $product->body }}</textarea>
    </div>

    <div class="form-group">
        <label for="price">Preço</label>
        <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ $product->slug }}">
    </div>

    <div class="form-group">
        <label for="store_id">Loja</label>
        <select name="store_id" id="store_id" class="form-control">
            @foreach($stores as $store)
                @if($store->id == $product->store_id)
                    <option value="{{ $store->id }}" selected>{{ $store->name }}</option>
                @endif
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>
@endsection