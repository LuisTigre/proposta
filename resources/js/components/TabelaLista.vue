<template>
  <div v-bind:class="defineTamanho">   
   <div class="table-responsive">     
    <!-- <div class="form-inline"> -->
    <div class="form-block">

      <div class="mb-3 row justify-content-end">
            <div class="col-md-9 mb-2">                
                <a v-if="criar && !modal" v-bind:href="criar" class="btn btn-primary btn-sm">novo</a>
                <modallink v-if="criar && modal" tipo="link" nome="adicionar" titulo="Novo" css="btn btn-primary btn-md"></modallink>
            </div>                            
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control"  placeholder="Buscar..." v-model="buscar">
            </div>                                    
        </div>          
    </div>

      <table class="table table-striped table-hover table-xs" style="font-size:11.5px;">
        <thead>
          <tr>            
            <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo,index) in titulos">{{ titulo }}</th>
            <th v-if="detalhe || editar || deletar ">Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in lista">
                   
            <td v-for="(i, key) in item">
              <span v-if="(key == 'status' && update_status && ternar_values)">
                <formulario v-if="deletar" v-bind:id="index + '_status'" v-bind:action="'/propostas/' + item.id" method="put"  v-bind:token="token" enctype="">                    
                    <input type="hidden" name="status" v-bind:value="i == ternar_values[0] ? ternar_values[1] : ternar_values[0]">                   
                    <a href="#" v-on:click="executaForm(index + '_status')">{{ i | formataData }}</a>
                </formulario>              

              </span>
              <template v-if="key == 'status' && (!update_status || !ternar_values)">{{ i | formataData }}</template>
              <template v-if="key != 'status'">{{ i | formataData }}</template>
            </td>            
            <td v-if="detalhe || editar || deletar">
              <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" v-bind:value="token">              

                <a v-if="detalhe && !modal" v-bind:href="detalhe"> Detalhe </a>
                <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo="Detalhe " css=""></modallink>

                <a v-if="editar && !modal" v-bind:href="editar"> Editar </a>
                <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo="Editar " css=""></modallink>

                <a href="#" v-on:click="executaForm(index)"> Deletar</a>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
  </div>  
  </div>
   
   
</template>

<script>
  export default {
    props:['titulos','itens','ordem','ordemcol','criar','detalhe','editar','deletar','index_url','token','modal','tamanho','update_status','ternar_values'],
     
      data: function(){
        return {
          buscar:'',
          ordemAux: this.ordem || 'asc',
          ordemcolAux: this.ordemcol ||  0,
        }
    },
    methods:{
        executaForm: function(index){
          console.log(index)
          if(index.toString().endsWith('_status')){
            document.getElementById(index).submit(); 
          }else{
            if (confirm("Deseja eliminar ?")) {
                  document.getElementById(index).submit();                 
            }
          }
        },
        ordenaColuna: function(coluna){
          this.ordemAuxCol = coluna;
          if(this.ordemAux.toLowerCase() == "asc"){
            this.ordemAux = 'desc';
          }else{
            this.ordemAux = 'asc';
          }
        },
       
        preecherDados:function(){
          axios.get(this.index_url).then((res) => {
                  this.itens.data = res.data
                  console.log(this.itens.data);               
                }).catch((err) => {
                  console.log(err);
                })  

        }
      },
      filters:{
        formataData: function(valor){
          if(!valor) return '';
          valor = valor.toString();
          if(valor.split('-').length == 3){
            valor = valor.split('-');
            return valor[2] + '/' + valor[1] + '/' + valor[0];
          }
          return valor;
        }
      },
    computed:{
        lista:function(){          

          let lista = this.itens.data;
          let ordem = this.ordemAux || "asc";
          let ordemcol = this.ordemcolAux || 0;
          ordem.toLowerCase();
          ordemcol = parseInt(ordemcol);

          if(ordem =="asc"){
            lista.sort(function(a,b){
            if(Object.values(a)[ordemcol]>Object.values(b)[ordemcol]){return 1;}
            if(Object.values(a)[ordemcol]<Object.values(b)[ordemcol]){return -1;}            
            return 0;           
          });          
        }else{          
            lista.sort(function(a,b){
            if(Object.values(a)[ordemcol]<Object.values(b)[ordemcol]){return 1;}
            if(Object.values(a)[ordemcol]>Object.values(b)[ordemcol]){return -1;}            
            return 0; 
        });
        }          
          if(this.buscar){
            return lista.filter(res => {
              res = Object.values(res);
              for(let k = 0;k < res.length; k++){
                if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                  return true;
                }
              }
              return false;
          });
          }

          return lista;
        },        
        defineTamanho:function(){
        if(!this.tamanho || (parseInt(this.tamanho) <= 2)){
          return "col-md-12";          
        }else{
          return "col-md-"+(parseInt(this.tamanho));

        }
      },     
      }
      
    }

</script>






