@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-2">Criar Produto</a>
    @if(count($products))
       <table class="table table-striped table-responsive table-dark">
        <thead>
            <tr>
                <th width="5%">Id.</th>
                <th width="40%">Nome</th>
                <th width="15%">Preço</th>
                <th width="20%">Loja</th>
                <th width="20%" class="text-right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(count($products))
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="post" class="delete" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
       </table>
    @endif

    @if(count($products))
        {{ $products->links() }}
    @endif

@endsection