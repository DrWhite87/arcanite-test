<?php

namespace App\Http\Controllers\Api;

use App\Data\UserData;
use App\Data\UserLoginData;
use App\Data\UserFormData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{

    /**
     * Register api
     *
     * @param UserFormData $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserFormData $data): \Illuminate\Http\JsonResponse
    {
        User::create($data->toArray());
        return $this->sendResponse([], 'User register');
    }

    /**
     * Token api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(['token' => $request->user()->createToken('Arcanite', ['global'])->plainTextToken], 'User token');
    }


    /**
     * Login api
     *
     * @param Request $request
     * @param UserLoginData $data
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request, UserLoginData $data): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($data->toArray())) {
            $request->session()->regenerate();
            return $this->sendResponse(['user' => UserData::from(Auth::user())], 'User login');
        }

        return $this->sendError('Validation Error.', ['email' => ['Unauthorised']], 422);
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        if (session()->has('temporary')) {
            session()->remove('temporary');
        }

        $request->session()->invalidate();
        return $this->sendResponse([], 'User logout');
    }
}
