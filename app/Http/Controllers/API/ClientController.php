<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Traits\ApiResponseTrait;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    //
    //Traits API
    use ApiResponseTrait;
    public function index()
    {
        $client = ClientResource::collection(getData(Client::class));
        return $this->apiResponse($client, ['تم ارجاع البيانات'], 200);
    }

    public function show($id)
    {
        $client = getDataById(Client::class, $id);
        if ($client) {
            return $this->apiResponse($client, ['تم ارجاع البيانات'], 200);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في ارجاع البيانات'], 401);
        }
    }

    public function store(Request $request)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('clients')->ignore($request->id)],
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $Client = dataStore(Client::class, $request);
        if ($Client) {
            return $this->apiResponse($Client, ['تم اضافة الييانات'], 201);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في اضافة البيانات'], 400);
        }
    }


    public function update(Request $request, $id)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('clients')->ignore($request->id)],
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $client = getDataById(Client::class, $id);
        if (!$client) {
            return $this->apiResponse(null, ['هناك خطأ في تعديل البيانات'], 404);
        }

        $client->update($request->all());

        if ($client) {
            return $this->apiResponse(new ClientResource($client), ['تم تعديل الييانات بطريقة صحيحة'], 200);
        }
    }

    public function destory($id)
    {
        $client = getDataById(Client::class, $id);

        if (!$client) {
            return $this->apiResponse(null, ['هناك خطأ في حذف البيانات'], 404);
        }

        $client->delete($id);

        if ($client) {
            return $this->apiResponse(null, ['تم الحذف الييانات بطريقة صحيحة'], 200);
        }
    }
}
