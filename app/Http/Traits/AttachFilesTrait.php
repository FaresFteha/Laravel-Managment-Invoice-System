<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;


trait AttachFilesTrait
{
    public function uploadFile($request, $name, $folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('Attachments/', $folder . '/' . $file_name, 'Client-Attachments');
    }


    public function deleteFile($name)
    {
        $exists = Storage::disk('Client-Attachments')->exists('Attachments/Client-Attachments/' . $name);

        if ($exists) {
            Storage::disk('Client-Attachments')->delete('Attachments/Client-Attachments/' . $name);
        }
    }

    public function deleteProduct($name)
    {
        $exists = Storage::disk('Product-Attachments')->exists('Attachments/Product-Attachments/' . $name);

        if ($exists) {
            Storage::disk('Product-Attachments')->delete('Attachments/Product-Attachments/' . $name);
        }
    }

    public function deleteinvoiceAttachments($name)
    {
        $exists = Storage::disk('Invoice-Attachments')->exists('Attachments/Invoice-Attachments/' . $name);

        if ($exists) {
            Storage::disk('Invoice-Attachments')->delete('Attachments/Invoice-Attachments/' . $name);
        }
    }
}
