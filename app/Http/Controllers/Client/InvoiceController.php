<?php

namespace App\Http\Controllers\Client;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $Incoices = Invoice::where('client_id', Auth::guard('client')->user()->id)
            ->paginate(10);
        return view('page.backend.Clients_Cpanel.Invoices.index', compact('Incoices'));
    }

    public function show($id)
    {
        // Retrieve an instance of the specified invoice object based on the given ID
        $invoice = getInvoice($id); // Retrieves an instance of the invoice object being displayed based on ID parameter

        // Render a view for the user to display the invoice data, passing in the retrieved $invoice and $idInvoiceAttachments as parameters
        return view('page.backend.Clients_Cpanel.Invoices.show', compact('invoice'));
    }

    public function payments($id)
    {
        // Retrieve all Payment instances associated with a given invoice ID
        $payments = Payment::where('client_id', Auth::guard('client')->user()->id)->get();

        // Check if there are any payments retrieved from the database
        if (empty($payments)) {
            // If no payments were found, display an error message to the user using toastr
            toastr()->error('لا يوجد مدفوعات لهذه الفاتورة');

            // Redirect the user back to the previous page
            return redirect()->back();
        } else {
            // If payments were found, render the 'payments' view and pass the relevant data through compact()
            return view('page.backend.Clients_Cpanel.Invoices.payments', compact('payments'));
        }
    }

    public function printFatora($id)
    {
        // This code retrieves an invoice record from the database based on its ID and passes it to a view for display

        $invoice = Invoice::where('id', $id)->first(); // Retrieve a single invoice record from the database based on the provided ID

        // Pass the retrieved invoice data to a view called 'invoicePrint' located in the 'page.backend.Invoices' directory
        return view('page.backend.Clients_Cpanel.Invoices.print_fatora', compact('invoice'));
    }
}
