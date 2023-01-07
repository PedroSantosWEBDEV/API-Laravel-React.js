<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUser;
use App\User;
use App\Services\ResponseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(StoreUser $request)
    {
        try{
            $user = $this
            ->user
            ->create([
               'name' => $request->get('name'),
               'email' => $request->get('email'),
               'password' => Hash::make($request->get('password')),
            ]);
         }catch(\Throwable|\Exception $e){
            return ResponseService::exception('users.store',null,$e);
         }
    }
}
