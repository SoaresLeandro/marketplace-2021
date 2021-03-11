@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Criar Produto</a>
    @if(count($products))
       <table class="table table-striped table-responsive table-dark">
        <thead>
            <tr>
                <th scope="col">Id.</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if(count($products))
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="post" class="delete">
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

    {{ $products->links() }}

@endsection