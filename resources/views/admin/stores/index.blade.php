@extends('layouts.app')

@section('content')
    @if(!$store)
    <a href="{{ route('admin.stores.create') }}" class="btn btn-success mb-2">Criar Loja</a>
    @endif
    @if($store)
       <table class="table table-striped table-responsive table-dark">
        <thead>
            <tr>
                <th width="5%">Id.</th>
                <th width="60%">Name</th>
                <th width="10%">Total de produtos</th>
                <th width="25%">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->products->count() }}</td>
                <td>
                    <a href="{{ route('admin.stores.edit', ['id' => $store->id]) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('admin.stores.destroy', ['id' => $store->id]) }}" class="btn btn-danger">Remover</a>
                </td>
            </tr>
        </tbody>
       </table>
    @endif

@endsection