<?php

namespace App\Repository;

use Mpdf\Mpdf;
use App\Models\Invoice;
use App\Models\Invoice_statu;
use App\RepositoryInterface\InvoiceStatusRepositoryInterface;

class InvoiceStatusRepository implements InvoiceStatusRepositoryInterface
{
    // The following function is called when the user visits the index page for the Invoice status
    public function index()
    {
        $Incoices = Invoice::query()

        // Use the `when` method to conditionally execute a statement based on a boolean value
        // If the 'keyword' field is not null, call the `search()` function with its value as an argument.
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })

        // Use the `orderBy` method to sort the results based on the values of 'sort_by' and 'order_by' parameters in the request.
        // The default sorting column will be 'id', and the default sorting order will be 'desc'.
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')

        // Use the `paginate` method to retrieve results and paginate them based on the value of 'limit_by' parameter in the request.
        // The default limit per page will be 10.
        ->paginate(\request()->limit_by ?? 10);
        return view('page.backend.Invoices.Invoicestatus.index', compact('Incoices'));
    }

    public function create()
    {
        $invoiceStatus = Invoice_statu::paginate(10);
        return view('page.backend.Invoices.Invoicestatus.statusall', compact('invoiceStatus'));
    }

    public function edit($id)
    {
        // gets the invoice's details based on the given id value
        $date['Invoice'] = getInvoice($id);
        // displays a view page where the user can change the invoice status
        // passes the retrieved data as the second parameter 
        return view('page.backend.Invoices.Invoicestatus.status_change', $date);
    }

    // The following function is called when the user wants to view the status of a specific invoice
    public function show($id)
    {

        $invoiceStatus = Invoice_statu::where('invoice_id', $id)->get();

        return view('page.backend.Invoices.Invoicestatus.status_show_specific', compact('invoiceStatus'));
    }

    // The following function is called when the user submits a form to create a new resource
    public function store($request)
    {
        // Get the invoice ID from the request
        $invoice_ID = getInvoice($request->id);

        try {
            // If the invoice status is "تحت المعالجة", update its value_status to 1 and create a new Invoice_statu record
            if ($request->status === "تحت المعالجة") {
                $invoice_ID->update([
                    "value_status" => 1,
                    "status" => $request->status,
                ]);
                Invoice_statu::create([
                    'invoice_id' =>  $request->id,
                    'status' => $request->status,
                    'value_status' => 1,
                    'created_by' => 'FaresFteha',
                ]);
            }
            // If the invoice status is "مرفوض", update its value_status to 6 and create a new Invoice_statu record
            elseif ($request->status === "مرفوض") {
                $invoice_ID->update([
                    "status" => $request->status,
                    "value_status" => 6,
                ]);

                Invoice_statu::create([
                    'invoice_id' => $request->id,
                    'status' => $request->status,
                    'value_status' => 6,
                    'created_by' => 'FaresFteha',
                ]);
            } elseif ($request->status === "ألغيت") {
                $invoice_ID->update([
                    "status" => $request->status,
                    "value_status" => 7,
                ]);

                Invoice_statu::create([
                    'invoice_id' => $request->id,
                    'status' => $request->status,
                    'value_status' => 7,
                    'created_by' => 'FaresFteha',
                ]);
            }
            // If the invoice status is anything else, update its value_status to 7 and create a new Invoice_statu record
            else {
                $invoice_ID->update([
                    "value_status" => 8,
                    "status" => $request->status,
                ]);

                Invoice_statu::create([
                    'invoice_id' => $request->id,
                    'status' => $request->status,
                    'value_status' => 8,
                    'created_by' => 'FaresFteha',
                ]);
            }

            // Display success message and redirect to invoices index page
            toastr()->success('تم تحديث حالة الفاتورة,العملية ناجحة.');
            return redirect()->route('invoices.index');
        }
        // Catch any exceptions and redirect back with an error message
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function exportstatysinvoices()
    {
        // This code generates a PDF file of invoice data using the mpdf library, Laravel framework, and Blade templating engine

        // Instantiate a new instance of the Mpdf class
        $mpdf = new Mpdf();

        // Retrieve all invoice data from the database
        $data  =  Invoice_statu::all();

        // Render a blade template called 'pdf' located in the 'page.backend.Invoices' directory and pass the retrieved invoice data as an associative array with the key 'data'
        $view  = view('page.backend.Invoices.PDF.exportstatusinvoice', compact('data'))->render();

        // Write the rendered blade template to the mpdf object for PDF generation
        $mpdf->WriteHTML($view);

        // Output the generated PDF file to the browser with filename 'invoice.pdf' and download option enabled
        $mpdf->Output('invoice-status.pdf', 'D');
    }
}
