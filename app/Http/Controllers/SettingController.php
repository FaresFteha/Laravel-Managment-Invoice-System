<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:الاعدادت', ['only' => ['index']]);
    }

    use AttachFilesTrait;
    public function index()
    {
        $collection = Setting::firstwhere('id', 1);
        return view('page.backend.setting.index', compact('collection'));
    }



    //Hero-Section-updating 
    public function updateSetting(Request $request)
    {


        try {
            $Setting = Setting::firstwhere('id', 1);
            $Setting->app_name = $request->app_name;
            $Setting->company_name = $request->company_name;
            $Setting->email = $request->email;
            $Setting->phone = $request->phone;
            $Setting->address = $request->address;
            $Setting->postal_code = $request->postal_code;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $Setting->photo = $photo;
                $this->uploadFile($request, 'photo', 'Logo');
            }
            $Setting->save();

            toastr()->success('تم تعديل البيانات!');
            return back();
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    } //endHero-Section-updating 


    public function clearCache()
    {
        Cache::clear();
        toastr()->success('تم مسح ذاكرة التخزين المؤقت للتطبيق!');
        return redirect()->back();
    }
}
