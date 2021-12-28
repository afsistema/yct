@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Usuários Cadastrados') }}
                    <a href="{{ ('/user/create/0') }}" class="btn btn-info" style="float: right">
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
                                <th>NOME</th>                                
                                <th>NIVEL DE ACESSO</th> 
                                <th>E-MAIL</th> 
                                <th style="width: 5%">STATUS</th>
                                <th style="width: 5%">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->roles }}
                                </td>    
                                <td>
                                    {{ $user->email }}
                                </td>                            
                                <td>
                                    {{ $user->status }}
                                </td>
                                <td nowrap style="text-align: right">
                                    <a href="{{ ('/user') }}/create/{{ $user->id }}" class="btn btn-secondary">
                                        Editar
                                    </a>   
                                    <a href="{{ ('/user') }}/delete/{{ $user->id }}" class="btn btn-danger">
                                        Excluir
                                    </a>  
                                                                                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection