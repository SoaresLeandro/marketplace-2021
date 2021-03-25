@extends('layouts.front')

@section('content')

<h2 class="alert alert-success">
    Seu pedido foi processado com sucesso.
</h2>

<h3 class="lead">
    Número do pedido: {{ request()->get('order') }}
</h3>
    
@endsection