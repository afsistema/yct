@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">                   
                    <h3>Número Cadastrado</h3>
                </div>

                <div class="card-body">                   

                    <form method="post" action="">
                        {{ csrf_field() }}
                        <div class="mb-3" class="form-control" >
                            <label for="customer_id" class="form-label">Cliente:</label>
                            
                            {{ $number->customer->name }}         

                        </div>
                        <div class="mb-3">
                          <label for="number" class="form-label">Número: </label>

                          {{ $number->number }}
                          
                        </div>                        
                        <div class="mb-3">
                            <label for="document" class="form-label">Status:</label>
                            
                            {{ $number->status }}                 
                                                                                       
                            
                        </div>
                        <div class="mb-3">
                            <section class="repeater">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Preferências Cadastradas</h3>
                                                
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
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>                          
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