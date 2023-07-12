<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\API\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    //

    //Traits API
    use ApiResponseTrait, AuthTrait;
    public function userDashboard()
    {
        $users = User::all();
        return $this->apiResponse($users, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
    }


    public function login(Request $request, $type)
    {

        try {
            //validated in api
            $validated = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validated->fails()) {
                return $this->apiResponse(null, $validated->errors(), 422);
            }

            $guard = null;

            if ($token = Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
                $guard = $this->chekGuard($request);
            } elseif ($token = Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
                $guard = $this->chekGuard($request);
            }

            if ($guard) {
                return $this->createNewToken($token, $guard);
            } else {
                return response()->json(['error' => 'هناك خطأ في اسم المستخدم او كلمة المرور'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['success' => false, $e->getMessage()], 500);
        }
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();
        return response()->json(['message' => 'تم تسجيل خروج المستخدم بنجاح']);

    }

    protected function createNewToken($token, $guard)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => Auth::guard($guard)->user(),
        ]);
    }
}
