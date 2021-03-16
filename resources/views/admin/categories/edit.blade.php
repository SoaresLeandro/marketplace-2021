@extends('layouts.app')

@section('content')
<form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome da Categoria</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" class="form-control" value="{{ $category->name }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição da Categoria</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $category->description }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>
@endsection