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
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('page.backend.setting.index', $setting);
    }

    

    //Hero-Section-updating 
    public function updateSetting(Request $request)
    {

        try {
            $info = $request->except('_token', '_method', 'photo');
            foreach ($info as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                Setting::where('key', 'photo')->update(['value' => $photo]);
                $this->uploadFile($request, 'photo', 'Logo');
            }
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
