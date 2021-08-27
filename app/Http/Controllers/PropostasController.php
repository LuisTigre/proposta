<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposta;
use App\Models\Cliente;
use App\Exports\PropostasExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class PropostasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $propostas = Proposta::lista(1000);
        $clientes = Cliente::all();
        // dd($propostas);

        return view('propostas.index', compact('propostas','clientes'));
    }    

    public function show($id)
    {
        
        $proposta = Proposta::find($id);

        return $proposta;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $proposta = Proposta::create($data);
        $proposta->parcela_valor =  (floatVal($proposta->valor_total) - floatVal($proposta->sinal)) / (floatVal($proposta->parcela_qtd) - 1);
        $proposta->parcela_data = $this->calcular_data_das_parcelas(4, $proposta->pagamento_data_inicio,"Y-m-d");
        $fileName = time().'_'.$request->file('arquivo')->getClientOriginalName();
        $filePath = $request->file('arquivo')->storeAs('uploads', $fileName, 'public');       
        $proposta->arquivo = '/storage/' . $filePath;
        $proposta->save();


        // $path = $request->file('arquivo')->store('ficheiros');
        return redirect()->back()->with('status', 'proposta adicionado com sucesso');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $proposta = Proposta::find($id);
        $proposta->parcela_valor =  round((floatVal($proposta->valor_total) - floatVal($proposta->sinal)) / (floatVal($proposta->parcela_qtd) - 1),2);
        $proposta->parcela_data = $this->calcular_data_das_parcelas(4, $proposta->pagamento_data_inicio,"Y-m-d");
        $proposta->update($data);
        return redirect()->back()->with('status', 'proposta actualizado com sucesso');
    }

    public function change_status(Request $request, $id)
    {
        $data = $request->all();
        Proposta::find($id)->update($data);
        return redirect(route('propostas.index'));
    }

    public function destroy($id)
    {
        Proposta::find($id)->delete();
        return redirect()->back();
    }

    public function export() 
{   
    return Excel::download(new PropostasExport, 'propostas.xlsx');
}

    public function calcular_data_das_parcelas($parcelas_qtd, $data_inicial, $format){
        $datas = '';
        $time = strtotime($data_inicial);

        for ($i=0; $i < $parcelas_qtd; $i++) { 
            $datas .= sprintf(
                '%sª Parcela: %s .        .', 
                 $i+1, $this->incrementaData($data_inicial, $i, $format)
            );
           
        }
        return $datas;
    }


    public function incrementaData($data_inicial, $i, $format)
    {        
        $time = strtotime($data_inicial);
        $final = date($format, strtotime("+$i month", $time));

        return $final;
    }
}
