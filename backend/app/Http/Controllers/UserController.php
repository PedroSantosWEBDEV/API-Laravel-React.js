<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUser;
use App\Services\ResponseService;
use App\Transformers\User\UserResource;
use App\User;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        try {
            $user = $this
                ->user
                ->create($request->all());
        } catch (\Throwable | \Exception$e) {
            return ResponseService::exception('users.store', null, $e);
        }

        return new UserResource($user, array('type' => 'store', 'route' => 'users.store'));
    }

    /**
     * Login the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $token = $this
            ->user
            ->login($credentials);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.login',null,$e);
        }

        return response()->json(compact('token'));

    }

    public function logout(Request $request) {
        // print_r($request->input('token'));
        // die;
        try {
            $this
            ->user
            ->logout();
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.logout',null,$e);
        }

        return response(['status' => true,'msg' => 'Deslogado com sucesso'], 200);
    }

}
