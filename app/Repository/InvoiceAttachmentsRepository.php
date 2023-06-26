<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_statu;
use App\RepositoryInterface\InvoiceAttachmentsRepositoryInterface;
use App\RepositoryInterface\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceAttachmentsRepository implements InvoiceAttachmentsRepositoryInterface
{
    use AttachFilesTrait;

    //Insert invoice Attachments
    public function store($request)
    {
        //Variables specific tp Invoice Attachments
        $Request_Invoice_Id = $request->invoice_id;
        $Request_Invoice_Number = $request->invoices_numbers;
        $Request_Created_By = 'FaresFteha';

        //Inseert in Invoice Attachments 
        $invoiceAttachments = new Invoice_attachment();
        $invoiceAttachments->invoice_id =   $Request_Invoice_Id;
        $invoiceAttachments->invoices_numbers =  $Request_Invoice_Number;
        $invoiceAttachments->created_by =  $Request_Created_By;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->getClientOriginalName();
            $invoiceAttachments->photo = $photo;
            $this->uploadFile($request, 'photo', 'Invoice-Attachments');
        }
        $invoiceAttachments->save();
        successAlert();
        return redirect()->back();
    }



    public function donlowad($filename)
    {
        return response()->download(public_path('storage/Attachments/Invoice-Attachments/' . $filename));
    }

    public function destroy($request)
    {
        try {
            //code...
            $this->deleteinvoiceAttachments($request->photo);
            Invoice_attachment::destroy($request->id);
            deleteAlert();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
