<?php

namespace App\Http\Controllers;
use App\Models\Votos;
use App\Models\Enquete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;

class VotosController extends Controller
{
    public function __construct(
        readonly private Votos $voto,
        readonly private Enquete $enquete,
    ) {
    }

    public function show($id)
    {
        $enquete = $this->enquete->find($id);

        $respostas = $enquete->respostas;

        $maxVotos = $respostas->map(
            fn($resposta) => $resposta->votos
                ->count()
        )
            ->max();

        $totalvotos = $respostas->map(
            fn($resposta) => $resposta->votos
                ->count()
        )
            ->sum();

        return view('countvotos', compact('enquete', 'respostas', 'totalvotos', 'maxvotos'));
    }

    public function vote(Request $request): RedirectResponse
    {
        $voto= $request->input('vote');

        $voto= $this->voto->create([
            'survey_option_id' => $voto,
            'user_id' => 2
        ]);

        $id = $voto->enqueteOption->enquete->id;

        return redirect("countvotos/$id");
    }

    public function update(Request $request, $id)
    {
        $voto= $request->answer;

        $respostas = $this->enquete->find($id);

        $arrrespostas = (array) json_decode($respostas->respostas);

        $arrrespostas[$voto] = (int) $arrrespostas[$voto] + 1;

        try {
            $this->enquete->where(['id' => $id])->update([
                'respostas' => json_encode($arrrespostas, JSON_UNESCAPED_UNICODE),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect("/countvotes/$id");
        } catch (Exception $e) {
            $error = $e;
            return view('fail', compact('error'));
        }
    }
}
