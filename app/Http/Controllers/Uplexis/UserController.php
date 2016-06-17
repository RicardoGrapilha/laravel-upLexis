<?php namespace App\Http\Controllers\Uplexis;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\Repository\UserRepository as User;

use Auth;
use DB;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(User $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $attempt = Auth::attempt([
            'usuario' => $request['usuario'],
            'password' => $request['senha']
        ], false);

        if($attempt){
            return redirect('sintegra');
        }

        return redirect('user/login')
            ->withInput($request->only('usuario'))
            ->withErrors(['Usuário ou Senha inválido']);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('user/login');
    }

    public function createUser()
    {
        return view('user.create');
    }

    public function saveUser(UserRequest $request)
    {

        DB::beginTransaction();

        try {
            $this->userRepository->create($request->all());
            DB::commit();

            $request->session()->flash('message-success', 'Usuário criado com sucesso!');
            return redirect()->route('user.create');

        } catch (ValidationException $e) {
            DB::rollback();
            return Redirect::back()
                ->withErrors($e->getErrors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
