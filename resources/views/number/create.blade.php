@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Cadastro de Número') }}
                </div>

                <div class="card-body">                   

                    <form method="post" action="">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Cliente</label>
                            <select name="customer_id" id="customer_id" class="form-control" required>
                                <option value="" >Selecione:</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{$customer->id == $number->customer_id ?'selected="selected"' : '' }}  > {{ $customer->name }} </option>
                                @endforeach                                                                           
                            </select>                              
                        </div>
                        <div class="mb-3">
                          <label for="number" class="form-label">Número</label>
                          <input type="text" class="form-control" name="number" id="number" minlength="8" maxlength="14" required
                            value="{{ $number->number ?? '' }}"
                          >
                        </div>                        
                        <div class="mb-3">
                            <label for="document" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{$number->status == 'active' ? 'selected="selected"' : ''}}>active</option>
                                <option value="inactive" {{$number->status == 'inactive' ? 'selected="selected"' : ''}} >inactive</option>
                                <option value="cancelled" {{$number->status == 'cancelled' ? 'selected="selected"' : ''}}>cancelled</option>                                                           
                            </select>
                        </div>
                        <div class="mb-3">
                            <section class="repeater">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Preferências</h3>
                                                <div class="col-md-2 col-12" style="float:right">
                                                    <div class="form-group">
                                                        <label class="form-label" for="btnPreference">&nbsp;</label>
                                                        <button type="button" id="btnPreference" class="btn btn-outline-secondary mr-1 form-control" data-repeater-create>
                                                            <i data-feather='plus'></i>
                                                            <span>Incluir</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div data-repeater-list="preferences">
                                                    <div data-repeater-item>
                                                        <div class="row d-flex align-items-end">
                                                            <div class="col-md-3 col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="preference_name">Nome Preferência</label>
                                                                    <input type="text" name="preference_name" id="preference_name" placeholder="Digite o Nome Preferência" class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="preference_value">Valor Preferência</label>
                                                                    <input type="text" name="preference_value" id="preference_name" placeholder="Digite o Valor Preferência" class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>                               
                                                            <div class="col-md-2 col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label " for="btnRemover">&nbsp;</label>
                                                                    <button type="button" id="btnRemover" class="btn btn-outline-danger text-nowrap px-1 waves-effect form-control" data-repeater-delete>
                                                                        <i data-feather='trash-2'></i>
                                                                        <span>Remover</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>    
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendor-script')
<!-- vendor files -->
<script src='{{ asset('js/jquery-1.11.1.js') }}'></script>
<script src='{{ asset('js/jquery.repeater.js') }}'></script>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        var qtd = 1;
        var $repeater = $('.repeater').repeater({
            show: function () {
                $(this).slideDown();  
                $(this).show(function(){
                    qtd++;                   
                });   
            },
            hide: function (deleteElement) {
                if (confirm('Tem certeza que deseja excluir essa Preferência?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

        $repeater.setList([ 
            @foreach($number->number_preferences as $preference) 
            { 
                'preference_name': '{{ $preference->name }}', 
                'preference_value': '{{ $preference->value }}',                  
            }, 
            @endforeach
        ]);
        
    });    
</script>
@endsection