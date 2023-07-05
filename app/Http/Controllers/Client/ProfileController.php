<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    use  AttachFilesTrait;

    public function index()
    {
        $profile = Client::findorfail(Auth::guard('client')->user()->id);
        return view('page.backend.Clients_Cpanel.Profile.setting', compact('profile'));
    }


    public function update(Request $request)
    {
        $profile = Client::findorfail(Auth::guard('client')->user()->id);
        if (!empty($request->password)) {
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->phone = $request->phone;
            $profile->email = $request->email;
            $profile->password = Hash::make($request->password);
            if ($request->hasFile('photo')) {
                // Check if a photo was uploaded through the request via the `hasFile()` method.
    
                $this->deleteFile($profile->photo);
                // Delete the previously uploaded photo file from the server using the `deleteFile()` function.
    
                $photo = $request->file('photo')->getClientOriginalName();
                $profile->photo = $photo;
                // Retrieve the name of the new photo file that was uploaded via the request using the `getClientOriginalName()` method,
                // then assign it to the `$Client->photo` property to store it in the database.
    
                $this->uploadFile($request, 'photo', 'Client-Attachments');
                // Upload the new photo file to the server using the `uploadFile()` function.
                // Save the updated `$Client` object to the database.
    
            }
            $profile->save();
        } else {
            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->phone = $request->phone;
            $profile->email = $request->email;
            if ($request->hasFile('photo')) {
                // Check if a photo was uploaded through the request via the `hasFile()` method.
    
                $this->deleteFile($profile->photo);
                // Delete the previously uploaded photo file from the server using the `deleteFile()` function.
    
                $photo = $request->file('photo')->getClientOriginalName();
                $profile->photo = $photo;
                // Retrieve the name of the new photo file that was uploaded via the request using the `getClientOriginalName()` method,
                // then assign it to the `$Client->photo` property to store it in the database.
    
                $this->uploadFile($request, 'photo', 'Client-Attachments');
                // Upload the new photo file to the server using the `uploadFile()` function.
                // Save the updated `$Client` object to the database.
    
            }
            $profile->save();
        }
     

        successAlert();
        return redirect()->back();
    }
}
