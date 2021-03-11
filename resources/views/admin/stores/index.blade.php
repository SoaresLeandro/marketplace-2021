@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.stores.create') }}" class="btn btn-success">Criar Loja</a>
    @if(count($stores))
       <table class="table table-striped table-responsive table-dark">
        <thead>
            <tr>
                <th scope="col">Id.</th>
                <th scope="col">Name</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>
                    <a href="{{ route('admin.stores.edit', ['id' => $store->id]) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('admin.stores.destroy', ['id' => $store->id]) }}" class="btn btn-danger">Remover</a>
                </td>
            </tr>
            @endforeach
        </tbody>
       </table>
    @endif

    {{ $stores->links() }}

@endsection