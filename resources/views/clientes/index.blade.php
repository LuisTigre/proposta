@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('propostas.index')}}">Propostas</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Clientes') }}</li>
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
                                v-bind:titulos="['#','Razao Soc','Nome','NCPJ',
                                                'Endereco','Email','Telefone','Responsavel',
                                                'CPF','Celular',
                                                ]"
                                v-bind:itens="{{json_encode
                                    ($clientes)}}"
                                    tamanho="12"
                                ordem="desc" ordemcol="3"
                                criar="#criar" editar="/clientes/" deletar="/clientes/" token="{{csrf_token()}}"
                                modal="sim" 
                                update_status="sim"
                                v-bind:ternar_values="['Aberto','Fechado']"
    
                            ></tabela-lista>
                            
                            <modal nome="adicionar" titulo="Adicionar Cliente">
                                <formulario id="formAdicionar" css="" action="{{route('clientes.store')}}" method="post" enctype="multipart/form-data" token="{{csrf_token()}}">
    
                                <div class="col-md-4">
                                    <label for="razao_social" class="form-label">Razão Social</label>
                                    <input type="text" class="form-control" id="razao_social" name="razao_social"  required>
                                    <div class="invalid-feedback">
                                    Preenche correctamente a razão social.!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"  required>
                                    <div class="invalid-feedback">
                                    Preenche um nome válido.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj"  required>
                                    <div class="invalid-feedback">
                                    Preenche um CNPJ válido.
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label for="endereco" class="form-label">Endereço</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco"  required>
                                    <div class="invalid-feedback">
                                    Preenche um endereço válido.
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend"  aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">
                                            Digite um email válido.
                                        </div>
                                    </div>
                                </div>                       
                                <div class="col-md-3">
                                    <label for="telefone" class="form-label">telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone"  required>
                                    <div class="invalid-feedback">
                                    Digite um número de telefone válido.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="nome_responsavel" class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel"  required>
                                    <div class="invalid-feedback">
                                    Digite o nome do responsável correctamente.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf"  required>
                                    <div class="invalid-feedback">
                                    Digite o CPF correctamente.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular"  required>
                                    <div class="invalid-feedback">
                                    Digite o Celular.
                                    </div>
                                </div>                       
                
                                </formulario>
                                <span slot="botoes">
                                <button form="formAdicionar" class="btn btn-info">Adicionar</button>
                                </span>
    
                            </modal>                         
                            
                                    
                             
                            

                            <modal nome="editar" titulo="Editar Proposta">
                            <formulario id="formEditar" v-bind:action="'/clientes/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{csrf_token()}}">
    
                                <div class="col-md-4">
                                    <label for="razao_social" class="form-label">Razão Social</label>
                                    <input type="text" class="form-control" id="razao_social" name="razao_social" v-model="$store.state.item.razao_social" required>
                                    <div class="invalid-feedback">
                                    Preenche correctamente a razão social.!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" v-model="$store.state.item.nome_fantasia" required>
                                    <div class="invalid-feedback">
                                    Preenche um nome válido.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="cnpj" class="form-label">CNPJ</label>
                                    <input type="text" class="form-control" id="cnpj" name="cnpj" v-model="$store.state.item.cnpj" required>
                                    <div class="invalid-feedback">
                                    Preenche um CNPJ válido.
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label for="endereco" class="form-label">Endereço</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" v-model="$store.state.item.endereco" required>
                                    <div class="invalid-feedback">
                                    Preenche um endereço válido.
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend" v-model="$store.state.item.email" aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">
                                            Digite um email válido.
                                        </div>
                                    </div>
                                </div>                       
                                <div class="col-md-3">
                                    <label for="telefone" class="form-label">telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" v-model="$store.state.item.telefone" required>
                                    <div class="invalid-feedback">
                                    Digite um número de telefone válido.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="nome_responsavel" class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" v-model="$store.state.item.nome_responsavel" required>
                                    <div class="invalid-feedback">
                                    Digite o nome do responsável correctamente.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" v-model="$store.state.item.cpf" required>
                                    <div class="invalid-feedback">
                                    Digite o CPF correctamente.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" v-model="$store.state.item.celular" required>
                                    <div class="invalid-feedback">
                                    Digite o Celular.
                                    </div>
                                </div>     
                
                                </formulario>
                                <span slot="botoes">
                                <button form="formEditar" class="btn btn-info">Atualizar</button>
                                </span>    
                            </modal>                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
