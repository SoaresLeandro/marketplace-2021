@extends('layouts.app')

@section('content')
<form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nome da Loja</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição da Loja</label>
        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}">
        @error('description')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
        @error('phone')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile_phone">Celular</label>
        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ old('mobile_phone') }}">
        @error('mobile_phone')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">

        @error('logo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</form>
@endsection