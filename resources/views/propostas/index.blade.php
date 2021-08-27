@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Propostas') }}</li>
                        </ol>
                    </nav>                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                     
                    
                    <div class="table-area">                                            
                            <tabela-lista
                                v-bind:titulos="['#','Cliente','Proposta feita em','Inicio de Pagamento',
                                                'Qtd de Parcelas','Sinal R$','Valor Parcela R$',
                                                'Total','Status',
                                                ]"
                                v-bind:itens="{{json_encode
                                    ($propostas)}}"
                                    tamanho="12"
                                ordem="desc" ordemcol="3"
                                criar="#criar" editar="/propostas/" deletar="/propostas/" token="{{csrf_token()}}"
                                modal="sim" 
                                update_status="sim"
                                v-bind:ternar_values="['Aberto','Fechado']"
    
                            ></tabela-lista>
                            
                            <modal nome="adicionar" titulo="Adicionar Proposta">
                                <formulario id="formAdicionar" css="" action="{{route('propostas.store')}}" method="post" enctype="multipart/form-data" token="{{csrf_token()}}">
    
                                    <div class="col-md-6">
                                        <label for="cliente_id" class="form-label">Cliente</label>
                                        <select class="form-control" id="cliente_id" name="cliente_id" required>
                                            @foreach($clientes as $key=>$cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nome_fantasia}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Preenche correctamente a cliente.!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="obra_endereco" class="form-label">Endereço da Obra</label>
                                        <input type="text" class="form-control" id="obra_endereco" name="obra_endereco" required>
                                        <div class="invalid-feedback">
                                        Preenche um endereço para a obra.
                                        </div>
                                    </div>                                        
                                    <div class="col-md-2">
                                        <label for="valor_total" class="form-label">Valor Total</label>
                                        <input type="text" class="form-control" id="valor_total" name="valor_total" required>
                                        <div class="invalid-feedback">
                                        Preenche um valor válido.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="sinal" class="form-label">Sinal</label>
                                        <input type="text" class="form-control" id="sinal" name="sinal" required>
                                        <div class="invalid-feedback">
                                        Preenche um Sinal válido.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parcela_qtd" class="form-label">Qtd de Parcelas</label>
                                        <input type="text" class="form-control" id="parcela_qtd" name="parcela_qtd" required>
                                        <div class="invalid-feedback">
                                        Preenche uma quantidade válida.
                                        </div>
                                    </div>                     
                                    <div class="col-md-2">
                                        <label for="pagamento_data_inicio" class="form-label">Data de Início de Pag.</label>
                                        <input type="date" class="form-control" id="pagamento_data_inicio" name="pagamento_data_inicio" required>
                                        <div class="invalid-feedback">
                                            Digite a data correctamente.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Aberto">Aberto</option>
                                            <option value="Fechado">Fechado</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        Selecione o status.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parcela_valor" class="form-label">Valor de Parcela</label>
                                        <input type="text" class="form-control" id="parcela_valor" name="parcela_valor" readonly>
                                        <div class="invalid-feedback">
                                        Preenche um Sinal válido.
                                        </div>
                                     </div>
                                    <div class="col-md-5">
                                        <label for="arquivo" class="form-label">Arquivo</label>
                                        <input type="file" class="form-control" id="arquivo" name="arquivo" required>
                                        <div class="invalid-feedback">
                                        carregue um arquivo.
                                    </div>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="parcela_data" class="form-label">Datas Parcela</label>
                                        <textarea class="form-control" rows="2" id="parcela_data" name="parcela_data" readonly></textarea>
                                        <div class="invalid-feedback">
                                            Digite a data correctamente.
                                        </div>
                                    </div>                                    
                
                                </formulario>
                                <span slot="botoes">
                                <button form="formAdicionar" class="btn btn-info">Adicionar</button>
                                </span>
    
                            </modal>                         
                            
                                    
                             
                            

                            <modal nome="editar" titulo="Editar Proposta">
                            <formulario id="formEditar" v-bind:action="'/propostas/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{csrf_token()}}">
    
                                    <div class="col-md-6">
                                        <label for="cliente_id" class="form-label">Cliente</label>
                                        <select class="form-control" id="cliente_id" v-model="$store.state.item.cliente_id" required>
                                            @foreach($clientes as $key=>$cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nome_fantasia}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Preenche correctamente a cliente.!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="obra_endereco" class="form-label">Endereço da Obra</label>
                                        <input type="text" class="form-control" id="obra_endereco" v-model="$store.state.item.obra_endereco" required>
                                        <div class="invalid-feedback">
                                        Preenche um endereço para a obra.
                                        </div>
                                    </div>                                        
                                    <div class="col-md-2">
                                        <label for="valor_total" class="form-label">Valor Total</label>
                                        <input type="text" class="form-control" id="valor_total" v-model="$store.state.item.valor_total" required>
                                        <div class="invalid-feedback">
                                        Preenche um valor válido.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="sinal" class="form-label">Sinal</label>
                                        <input type="text" class="form-control" id="sinal" v-model="$store.state.item.sinal" required>
                                        <div class="invalid-feedback">
                                        Preenche um Sinal válido.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="parcela_qtd" class="form-label">Qtd de Parcelas</label>
                                        <input type="text" class="form-control" id="parcela_qtd" v-model="$store.state.item.parcela_qtd" required>
                                        <div class="invalid-feedback">
                                        Preenche uma quantidade válida.
                                    </div>
                                </div>                     
                                <div class="col-md-2">
                                    <label for="parcela_valor" class="form-label">Valor de Parcela</label>
                                    <input type="text" class="form-control" id="parcela_valor" v-model="$store.state.item.parcela_valor" readonly>
                                    <div class="invalid-feedback">
                                    Preenche um Sinal válido.
                                    </div>
                                 </div>
                                    <div class="col-md-2">
                                        <label for="pagamento_data_inicio" class="form-label">Data de Início de Pag.</label>
                                        <input type="date" class="form-control" id="pagamento_data_inicio" v-model="$store.state.item.pagamento_data_inicio" required>
                                        <div class="invalid-feedback">
                                            Digite a data correctamente.
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status" v-model="$store.state.item.status" required>
                                            <option value="Aberto">Aberto</option>
                                            <option value="Fechado">Fechado</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        Selecione o status.
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-5">
                                        <label for="arquivo" class="form-label">Arquivo</label>
                                        <input type="file" class="form-control" id="arquivo" v-model="$store.state.item.arquivo" required>
                                        <div class="invalid-feedback">
                                        carregue um arquivo.
                                        </div>
                                    </div> -->
                                    <div class="col-md-7">
                                        <label for="parcela_data" class="form-label">Datas Parcela</label>
                                        <textarea class="form-control" rows="2" id="parcela_data" v-model="$store.state.item.parcela_data" readonly></textarea>
                                        <div class="invalid-feedback">
                                            Digite a data correctamente.
                                        </div>
                                    </div>                                    
                
                                </formulario>
                                <span slot="botoes">
                                <button form="formEditar" class="btn btn-info">Atualizar</button>
                                </span>
    
                            </modal>   

                            <div class='mt-1'>
                                <a href="{{route('propostas.export')}}"  class="btn btn-primary btn-md">Exportar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
