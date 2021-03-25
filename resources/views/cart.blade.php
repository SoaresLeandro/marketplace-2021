@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Carrinho de Compras</h2>
            <hr>
        </div>

        @if (!$cart)
            <div class="container alert alert-warning">Carrinho vazio...</div>
        @else
        <div class="col-sm-12">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp

                    @foreach ($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['amount'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>{{ $item['amount'] }}</td>
                            <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('cart.remove', ['slug' => $item['slug']]) }}" class="btn btn-danger btn-sm">Tirar do carrinho</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <td colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>                    
                </tbody>
            </table>

            <div class="col-sm-12">
                <a href="{{ route('checkout.index') }}" class="btn btn-success float-right">Concluir Compra</a>
                <a href="{{ route('cart.cancel') }}" class="btn btn-danger float-left">Cancelar Compra</a>
            </div>
        </div>
        @endif
    </div>
@endsection