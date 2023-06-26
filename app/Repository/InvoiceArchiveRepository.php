<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Invoice;
use App\RepositoryInterface\InvoiceArchiveRepositoryInterface;

class InvoiceArchiveRepository implements InvoiceArchiveRepositoryInterface
{
    // The following code imports the AttachFilesTrait class into the current file.
    use AttachFilesTrait;

    // The following code defines a public method called 'index' in a class.
    public function index()
    {

        // This line retrieves all of the trashed invoice records from the database.
        $Incoices = Invoice::onlyTrashed()->get();

        // This line loads the view named 'index' located in the 'page.backend.Invoices.InvoiceArchive' folder,
        // and passes the retrieved trashed invoice records as a variable named "Incoices".
        return view('page.backend.Invoices.InvoiceArchive.index', compact('Incoices'));
    }

    // The following code defines a public method called 'update' in a class.
    // It accepts a parameter named $request.
    public function update($request)
    {
        // This code restores a soft-deleted invoice, identified by its ID, from the database.
        invoice::withTrashed()->where('id', $request->id)->restore();

        // Display a success message to the user using toastr (a notification package for the web).
        toastr()->success('تم ارجاعها الى الفواتير، العملية ناجحة.');

        // Redirect the user back to whatever page they were on before this action was performed.
        return redirect()->back();
    }

    // The following code defines a public method called 'destroy' in a class.
    // It accepts a parameter named $request.
    public function destroy($request)
    {
        // This code deletes a particular invoice and its attachments permanently from the database.
        // It first retrieves the soft-deleted invoice by ID.
        $invoice_Id = invoice::withTrashed()->firstwhere('id', $request->id);

        // Then it calls the `forceDelete` method to remove the invoice from the database permanently.
        $invoice_Id->forceDelete();

        // It also calls the `deleteinvoiceAttachments` method to delete any attachments associated with the invoice.
        $this->deleteinvoiceAttachments($request->photo);

        // Finally, it calls the `deleteAlert` function to display a success message to the user.
        deleteAlert();

        // The user is then redirected back to the previous page they were on before performing this operation.
        return redirect()->back();
    }
}
