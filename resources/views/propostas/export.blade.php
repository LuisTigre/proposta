@extends('layouts.app')

@section('content')
<div class="container">
                    
        <div class="table-area">                                            
                <tabela-lista
                    v-bind:titulos="['#','Cliente','Proposta feita em','Inicio de Pagamento',
                                    'Servicos','Qtd de Parcelas','Sinal R$','Valor Parcela R$',
                                    'Total','Status'
                                    ]"
                    v-bind:itens="{{json_encode
                        ($propostas)}}"
                    tamanho="12"
                    ordem="desc" ordemcol="3"
                    

                ></tabela-lista>
                
                
        </div>
  </div>
            


@endsection
