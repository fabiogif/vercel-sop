@extends('adminlte::page')
@section('title', 'Ocorrências')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Painel de Controle</a> </li>
        <li class="breadcrumb-item active"><a href="{{ route('occurrences.index') }}">Ocorrência</a> </li>
    </ol>

    <h1 class="m-0 text-dark">Ocorrência
        <a href="{{ route('occurrences.create') }}" class="btn btn-primary mr-5">
            <i class="fas fa-save"></i>
            <span class=m-4>Adicionar</span>
        </a>
    </h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')

        <div class="card-header">
            <form action="{{ route('occurrences.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control mr-2" name="filter" placeholder="Titulo"
                        value="{{ $filters['filter'] ?? '' }}">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                        <span class=m-4>Pesquisar</span>
                    </button>
                </div>
            </form>
        </div>


        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Titulo</th>
                        <th>Tipo de Ocorrência</th>
                        <th>Orgão Ocorrência</th>
                        <th>E-mail</th>
                        <th>Ultima atualização</th>
                        <th width="200px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($occurrences as $occurrence)
                        <tr>
                            <td>{{ $occurrence->name }}</td>
                            <td>{{ $occurrence->title }}</td>
                            <td>{{ $occurrence->nameType }}</td>
                            <td>{{ $occurrence->nameIssuings }}</td>
                            <td>{{ $occurrence->email }}</td>

                            <td>{!! date('d/m/Y - h:m:s', strtotime($occurrence->updated_at)) !!} </td>
                            <td style="width: 10px">
                                <a href="{{ route('occurrences.edit', $occurrence->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('occurrences.show', $occurrence->id) }}" class="btn btn-info"><i
                                        class="fas fa-search"></i></a>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    @if (count($occurrences) == 0)
                        <td>Não existe informações</td>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $occurrences->appends($filters)->links() !!}
            @else
                {!! $occurrences->links() !!}
            @endif
        </div>
    </div>
@stop
