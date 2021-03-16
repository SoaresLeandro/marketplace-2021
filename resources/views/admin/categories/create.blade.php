@extends('layouts.app')

@section('content')
<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nome da Categoria</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição da Categoria</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>
@endsection