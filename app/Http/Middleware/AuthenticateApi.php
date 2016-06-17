<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Input;


class AuthenticateApi
{

    public function handle($request, Closure $next)
    {
        $auth = Input::only('auth');

        $attempt = Auth::attempt([
            'usuario' => $auth['auth']['user'],
            'password' => $auth['auth']['passw']
        ], false);

        if(!$attempt){
            return response()->json([
                'error' => 'true',
                'response' => 'Usuário ou Senha inválido',
                'status_code' => '401'
            ], 401);
        }

        return $next($request);
    }
}
