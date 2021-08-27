<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proposta extends Model
{
    use HasFactory;

    protected $fillable = ['obra_endereco','valor_total','sinal','parcela_qtd',
    'parcela_valor','pagamento_data_inicio','parcela_data',
    'arquivo','status','cliente_id'];  

    public function cliente()
   {
   	return $this->belongsTo('App\Models\Cliente');
   }

   public static function lista($paginate)
   {    

           $proposta_lista = DB::table('propostas')
                        ->join('clientes','clientes.id','=','propostas.cliente_id')      
                        ->select('propostas.id','clientes.nome_fantasia as cliente',
                        DB::raw("date(propostas.created_at) as proposta_feita_em"),
                        'propostas.pagamento_data_inicio','propostas.parcela_qtd',
                        'propostas.sinal',DB::raw("round(propostas.parcela_valor,2)"),
                        DB::raw('propostas.valor_total'),
                        'propostas.status')        
                        ->orderBy('propostas.created_at','DESC')
                        ->paginate($paginate);
                      
       
       return $proposta_lista;
   }

}
