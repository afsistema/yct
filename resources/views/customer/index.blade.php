@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Clientes Cadastrados') }}
                    <a href="{{ ('/customer/create/0') }}" class="btn btn-info" style="float: right">
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
                                <th>USUÁRIO</th>
                                <th>NOME</th>
                                <th>DOCUMENTO</th>
                                <th style="width: 5%">STATUS</th>
                                <th style="width: 5%">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>
                                    {{ $customer->user->name }}
                                </td>
                                <td>
                                    {{ $customer->name }}
                                </td>
                                <td>
                                    {{ $customer->document }}
                                </td>
                                <td>
                                    {{ $customer->status }}
                                </td>
                                <td nowrap style="text-align: right">
                                    <a href="{{ ('/customer') }}/create/{{ $customer->id }}" class="btn btn-secondary">
                                        Editar
                                    </a>   
                                    <a href="{{ ('/customer') }}/delete/{{ $customer->id }}" class="btn btn-danger">
                                        Excluir
                                    </a>  
                                                                                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    {{ $customers->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection