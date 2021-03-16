@extends('layouts.app')

@section('content')
    
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-2">Criar Categoria</a>

<table class="table table-striped table-responsive table-dark">
    <thead>
        <tr>
            <th width="5%">Id.</th>
            <th width="35%">Nome</th>
            <th width="38%">Descrição</th>
            <th width="22%" class="text-right">Ações</th>
        </tr>
    </thead>
    <tbody>
        @if(count($categories))
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post" style="display: inline">
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


@endsection