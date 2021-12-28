@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Cadastro de Cliente') }}
                </div>

                <div class="card-body">                   

                    <form method="post" action="">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Usuário</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="" >Selecione:</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{$user->id == $customer->user_id ?'selected="selected"' : '' }}  > {{ $user->name }} </option>
                                @endforeach                                                                           
                            </select>                              
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Nome</label>
                          <input type="text" class="form-control" name="name" id="name" required
                            value="{{ $customer->name ?? '' }}"
                          >
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="document" id="document" minlength="6" maxlength="12" required
                              value="{{ $customer->document ?? '' }}"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="new" {{$customer->status == 'new' ? 'selected="selected"' : ''}}>new</option>
                                <option value="active" {{$customer->status == 'active' ? 'selected="selected"' : ''}}>active</option>
                                <option value="suspended" {{$customer->status == 'suspended' ? 'selected="selected"' : ''}} >suspended</option>
                                <option value="cancelled" {{$customer->status == 'cancelled' ? 'selected="selected"' : ''}}>cancelled</option>                                                              
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
