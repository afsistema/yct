@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Cadastro de Usuário') }}
                </div>

                <div class="card-body">                   

                    <form method="post" action="">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" id="name"  required
                              value="{{ $user->name ?? '' }}"
                            >
                        </div> 
                        <div class="mb-3">
                            <label for="document" class="form-label">Nivel de Acesso</label>
                            <select name="roles" id="roles" class="form-control" required>
                                <option value="Administrador" {{$user->roles == 'Administrador' ? 'selected="selected"' : ''}}>Administrador</option>
                                <option value="Customer" {{$user->roles == 'Customer' ? 'selected="selected"' : ''}} >Customer
                                </option>      
                            </select>
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label" for="nome">E-mail</label>
                            <input type="email" name="email" class="form-control" id="email" 
                            placeholder="Digite o E-mail" required value="{{ $user->email ?? '' }}"/>
                            <small class="form-text text-muted">Será utilizado para acesso ao Sistema</small>
                        </div>    
                        <div class="mb-3">
                            <label class="form-label" for="nome">Senha</label>
                            <input type="password" name="password" class="form-control" id="password" 
                            placeholder="Digite a Senha" />
                            <small class="form-text text-muted">Será utilizado para acesso ao Sistema</small>
                        </div>                       
                        <div class="mb-3">
                            <label for="document" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{$user->status == 'active' ? 'selected="selected"' : ''}}>active</option>
                                <option value="inactive" {{$user->status == 'inactive' ? 'selected="selected"' : ''}} >inactive</option>                     
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
