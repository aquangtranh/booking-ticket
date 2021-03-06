<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use App\Http\Controllers\Api\ApiController;
use App\Jobs\SendMailJob;
use PHPUnit\Framework\MockObject\Stub\Exception;

class RegisterController extends ApiController
{
    /**
     * Register user function
     *
     * @param RegisterUserRequest $request request
     *
     * @return void
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $request->except(['role', 'remember_token']);
        $datas = [
            'email' => $user['email'],
            'password' => $user['password']
        ];
        $user['password'] = bcrypt($user['password']);

        try {
            $user = User::create($user);
            $this->dispatch(new SendMailJob('admin.pages.users.mail', $user['email'], $datas));
            $data['user'] = User::find($user->id);
            $data['token'] = $user->createToken('token')->accessToken;
            return $this->successResponse($data, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->errorResponse(config('define.register.fail'), Response::HTTP_UNAUTHORIZED);
        }
    }
}
