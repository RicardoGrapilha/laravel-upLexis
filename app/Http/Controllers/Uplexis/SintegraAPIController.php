<?php namespace App\Http\Controllers\Uplexis;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\SintegraRepository as Sintegra;

use Auth;
use DB;

class SintegraAPIController extends Controller
{
    protected $sintegra;

    public function __construct(Sintegra $sintegra)
    {
        $this->sintegra = $sintegra;
    }

    /**
     * Consultando CNPJ na Sintegra
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Consulta(Request $request)
    {
        $error = 'true';
        $response = 'Informe um CNPJ para consulta';
        $status_code = '400';

        if ($request->cnpj) {
            $json = $this->sintegra->ConsultaSintegra($request->cnpj);

            if ($json == 404) {
                $response = 'Houver um problema com a consulta na Sintegra';
                $status_code = '400';
            } else if ($json == 400) {
                $response = 'CNPJ não localizado';
                $status_code = '400';
            } else {
                $error = 'false';
                $response = $json;
                $status_code = '200';
            }
        }

        return response()->json([
            'error' => $error,
            'response' => $response,
            'status_code' => $status_code
        ], $status_code);
    }
}
