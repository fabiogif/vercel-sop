@extends('adminlte::page')

@section('title', "Detalhes Tipo de Ocorrência { $statusOccurrence->name }")

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes Status de Ocorrência <b>{{ $statusOccurrence->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @csrf
            <div class="row">
                <ul>
                    <li><b>Nome:</b> {{ $statusOccurrence->name }}</li>
                </ul>
            </div>
            <!--row-->
            @include('admin.includes.alerts')

            <form action="{{ route('statusOccurrences.destroy', $statusOccurrence->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="far fa-trash-alt"></i>
                    <span class=m-4>Excluir</span>
                </button>
            </form>
        </div>
        <!--card-body-->
    </div>
    <!--card-->
@endsection
