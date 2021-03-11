@extends('layouts.app')

@section('content')
<form action="{{ route('admin.products.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nome do Produto</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" class="form-control" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição do Produto</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="body">Conteúdo</label>
        <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="3"> {{ old('body') }}</textarea>
        @error('body')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Preço</label>
        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
        @error('price')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>
@endsection