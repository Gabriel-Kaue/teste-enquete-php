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

    public function store(EnqueteRequest $request): RedirectResponse|View
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

            return view('erro', compact('errors'));
        }
    }
    public function show($id): View
    {
        $enquete = $this->enquete->find($id);
        $respostas = $enquete->respostas;
        return view('mostrar', compact('enquete','respostas'));
    }
    public function edit($id): View{
        $enquete = $this->enquete->find($id);
        return view('create', compact('enquete'));
    }
    public function destroy($id):bool{
        return (bool) $this->enquete->destroy($id);
    }
    public function update(EnqueteRequest $enqueteRequest, int $id): RedirectResponse|View
    {
        DB::beginTransaction();
        try {
            $respostas = $enqueteRequest->input('resposta');
            $enquete = $this->enquete->find($id);
            $enquete->finish_at = str_replace('T', ' ', $enqueteRequest->input('dtFim'));
            $enquete->save();

            foreach ($respostas as $resposta) {
                $resposta = $this->$respostas
                    ->where('textoResp', $resposta)
                    ->first();

                if (! $resposta) {
                    $this->respostas->create([
                        'textoResp' => $resposta,
                        'enquete_id' => $enquete->id
                    ]);
                }
            }
            DB::commit();

            return redirect('survey');
        }catch (Exception $e) {
            $erros = $e;
            DB::rollBack();
            return view('erro', compact('erros'));        }
    }
}
