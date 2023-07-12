<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\Traits\ApiResponseTrait;
use App\Models\Product;

class ProductController extends Controller
{
    //
    use ApiResponseTrait;

    public function index()
    {

        $Product = getData(Product::class);
        //API with response in trait
        return $this->apiResponse($Product, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
    }

    public function show($id)
    {
        //CatrgoryResource to Protected Attr 
        $Product = getDataById(Product::class, $id);
        if ($Product) {
            return $this->apiResponse($Product, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في ارجاع البيانات'], 401);
        }
    }

    public function store(Request $request)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'code' => ['required', Rule::unique('products')->ignore($request->id)],
            'name' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required|numeric',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $Product = dataStore(Product::class, $request);
        if ($Product) {
            return $this->apiResponse($Product, ['تم اضافة الييانات'], 201);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في اضافة البيانات'], 400);
        }
    }


    public function update(Request $request, $id)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'code' => ['required', Rule::unique('products')->ignore($request->id)],
            'name' => 'required',
            'category_id' => 'required',
            'unit_price' => 'required|numeric',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $Product = getDataById(Product::class, $id);

        if (!$Product) {
            return $this->apiResponse(null, ['هناك خطأ في تعديل البيانات'], 404);
        }

        $Product->update($request->all());

        if ($Product) {
            return $this->apiResponse($Product, ['تم تعديل الييانات بطريقة صحيحة'], 200);
        }
    }

    public function destory($id)
    {
        $Product = getDataById(Product::class, $id);

        if (!$Product) {
            return $this->apiResponse(null, ['هناك خطأ في حذف البيانات'], 404);
        }

        $Product->delete($id);

        if ($Product) {
            return $this->apiResponse(null, ['تم الحذف الييانات بطريقة صحيحة'], 200);
        }
    }
}
