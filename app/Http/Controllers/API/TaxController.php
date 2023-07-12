<?php

namespace App\Http\Controllers\API;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\Traits\ApiResponseTrait;

class TaxController extends Controller
{
    //

    use ApiResponseTrait;

    public function index()
    {

        $tax = getData(Tax::class);
        //API with response in trait
        return $this->apiResponse($tax, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
    }

    public function show($id)
    {
        //CatrgoryResource to Protected Attr 
        $tax = getDataById(Tax::class, $id);
        if ($tax) {
            return $this->apiResponse($tax, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في ارجاع البيانات'], 401);
        }
    }

    public function store(Request $request)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('taxes')->ignore($request->id)],
            'value' => 'required|integer'
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $tax = dataStore(Tax::class, $request);
        if ($tax) {
            return $this->apiResponse($tax, ['تم اضافة الييانات'], 201);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في اضافة البيانات'], 400);
        }
    }


    public function update(Request $request, $id)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('taxes')->ignore($request->id)],
            'value' => 'required|integer'
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $tax = getDataById(Tax::class, $id);

        if (!$tax) {
            return $this->apiResponse(null, ['هناك خطأ في تعديل البيانات'], 404);
        }

        $tax->update($request->all());

        if ($tax) {
            return $this->apiResponse($tax, ['تم تعديل الييانات بطريقة صحيحة'], 200);
        }
    }

    public function destory($id)
    {
        $tax = getDataById(Tax::class, $id);

        if (!$tax) {
            return $this->apiResponse(null, ['هناك خطأ في حذف البيانات'], 404);
        }

        $tax->delete($id);

        if ($tax) {
            return $this->apiResponse(null, ['تم الحذف الييانات بطريقة صحيحة'], 200);
        }
    }
}
