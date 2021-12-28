@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Numeros Cadastrados') }}
                    <a href="{{ ('/number/create/0') }}" class="btn btn-info" style="float: right">
                        + Novo
                    </a>
                </div>

                <div class="card-body">     
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif               
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CLIENTE</th>                                
                                <th>NÚMERO</th>                                
                                <th style="width: 5%">STATUS</th>
                                <th style="width: 5%">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($numbers as $number)
                            <tr>
                                <td>
                                    {{ $number->customer->name }}
                                </td>
                                <td>
                                    {{ $number->number }}
                                </td>                                
                                <td>
                                    {{ $number->status }}
                                </td>
                                <td nowrap style="text-align: right">
                                    <a href="{{ ('/number')}}/show/{{ $number->id }}" class="btn btn-success">
                                        Detalhes
                                    </a>
                                    <a href="{{ ('/number') }}/create/{{ $number->id }}" class="btn btn-secondary">
                                        Editar
                                    </a>   
                                    <a href="{{ ('/number') }}/delete/{{ $number->id }}" class="btn btn-danger">
                                        Excluir
                                    </a>  
                                                                                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    {{ $numbers->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection