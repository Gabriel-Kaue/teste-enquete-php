<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\Respostas;
use Exception;
use App\Http\Requests\EnqueteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EnqueteController extends Controller
{
    public function __construct(
        readonly private Enquete $enquete,
        readonly private Respostas $respostas,
    ){}
    public function index(): View{
        $enquetes = $this->enquete->all();
        foreach ($enquetes as $enquete) {
            $end = $enquete->dtFim;
            if(strtotime($end)<=time()){
                $this->enquete->destroy($enquete->id);
            }
        }
        $enquetes = $this->enquete->all();
        return view('index', compact('enquetes'));
    }
    public function create(): View{
        return view('create');
    }

    public function store(EnqueteRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try{
            $respostas = $request->input('resposta');
            $enquete = $this->enquete->create([
                'titulo' => $request->input('titulo'),
                'dtFim' => str_replace('T',' ', $request->input('dtFim'))
            ]);
            foreach($respostas as $ $resposta){
                $this->respostas->create([
                    'textoResp' => $respostas,
                    'enquete_id' => $enquete->id
                ]);
            }
            DB::commit();
            return redirect('enquete');
        } catch (Exception $e) {
            $errors = $e;
            DB::rollBack();

            return view('erro');
        }
    }
}
