@extends('layouts.app')

@section('content')
<form action="{{ route('admin.stores.update', ['id' => $store->id]) }}" method="post">
    @csrf
    <!-- @method('PUT') -->
    <div class="form-group">
        <label for="name">Nome da Loja</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" class="form-control" value="{{ $store->name }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição da Loja</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $store->description }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $store->phone }}">
        @error('phone')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile_phone">Celular</label>
        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ $store->mobile_phone }}">
        @error('mobile_phone')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ $store->slug }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</form>
@endsection