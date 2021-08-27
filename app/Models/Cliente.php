<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use HasFactory;


    protected $fillable = ['razao_social','nome_fantasia','cnpj','endereco',
    'email','telefone','nome_responsavel','cpf','celular'];   

    public function propostas()
   {
   	return $this->hasMany('App\Models\Proposta');
}   

   public static function lista($paginate)
   {    

        $proposta_lista = DB::table('clientes')                      
                    ->select('clientes.id','clientes.razao_social','clientes.nome_fantasia',
                    'clientes.cnpj','clientes.endereco','clientes.email',
                    'clientes.telefone','clientes.email','clientes.telefone',
                    'clientes.nome_responsavel','clientes.cpf','clientes.celular')        
                ->orderBy('clientes.nome_fantasia','DESC')
                    ->paginate($paginate);
                      
       
       return $proposta_lista;
   }
}
