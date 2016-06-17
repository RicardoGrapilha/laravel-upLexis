<?php namespace App\Http\Controllers\Uplexis;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\SintegraRepository as Sintegra;

class SintegraController extends Controller
{
    protected $sintegra;

    public function __construct(Sintegra $sintegra)
    {
        $this->sintegra = $sintegra;
    }

    public function index(Request $request)
    {
        $menu_active = 'consulta';
        $json = [];
        if($request->cnpj){
            $json = $this->sintegra->ConsultaSintegra($request->cnpj);
        }
        return view('sintegra.index', compact('json', 'menu_active'));
    }

    public function show()
    {
        $menu_active = 'listar';
        $lista = $this->sintegra->findBy([['idusuario', '=', auth()->user()->id]]);
        return view('sintegra.show', compact('menu_active', 'lista'));
    }

    public function delete(Request $request)
    {
        $lista = $this->sintegra->findBy([
            ['id', '=', $request->id],
            ['idusuario', '=', auth()->user()->id]
        ])->first();

        if($lista){
            $this->sintegra->delete($lista->id);
        }

        return response()->json(['response' => true], 200);
    }
}
