<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Traits\ApiResponseTrait;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatrgoryResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //Traits API
    use ApiResponseTrait;

    public function index()
    {

        $categories = CatrgoryResource::collection(getData(category::class));
        //API with response in trait
        return $this->apiResponse($categories, ['تم ارجاع الييانات بطريقة صحيحة'], 200);
    }

    public function store(Request $request)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'name' => [
                'required', Rule::unique('categories')->ignore($request->id),
                'max:40'
            ],
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $categories = dataStore(category::class, $request);
        if ($categories) {
            return $this->apiResponse($categories, ['تم اضافة الييانات'], 201);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في اضافة البيانات'], 400);
        }
    }
    public function show($id)
    {
        //CatrgoryResource to Protected Attr 
        $categories = getDataById(category::class, $id);
        if ($categories) {
            return $this->apiResponse(new CatrgoryResource(category::find($id)), ['تم ارجاع الييانات بطريقة صحيحة'], 200);
        } else {
            return $this->apiResponse(null, ['هناك خطأ في ارجاع البيانات'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        //validated in api
        $validated = Validator::make($request->all(), [
            'name' => [
                'required', Rule::unique('categories')->ignore($request->id),
                'max:40'
            ],
        ]);

        if ($validated->fails()) {
            return $this->apiResponse(null, $validated->errors(), 400);
        }

        $categories = getDataById(category::class, $id);

        if (!$categories) {
            return $this->apiResponse(null, ['هناك خطأ في تعديل البيانات'], 404);
        }

        $categories->update($request->all());

        if ($categories) {
            return $this->apiResponse(new CatrgoryResource($categories), ['تم تعديل الييانات بطريقة صحيحة'], 200);
        }
    }

    public function destory($id)
    {
          $categories = getDataById(category::class, $id);

        if (!$categories) {
            return $this->apiResponse(null, ['هناك خطأ في حذف البيانات'], 404);
        }

        $categories->delete($id);

        if ($categories) {
            return $this->apiResponse(null, ['تم الحذف الييانات بطريقة صحيحة'], 200);
        }
    }
}
