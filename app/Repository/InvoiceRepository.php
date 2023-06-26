<?php

namespace App\Repository;

use PDF;
use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Invoice_statu;
use Illuminate\Routing\Route;
use App\Models\Invoice_attachment;
use Illuminate\Support\Facades\DB;
use App\Notifications\InvoiceCreate;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\AttachFilesTrait;
use Illuminate\Support\Facades\Notification;
use App\RepositoryInterface\InvoiceRepositoryInterface;


class InvoiceRepository implements InvoiceRepositoryInterface
{
    // The following code is importing a trait called "AttachFilesTrait".
    use AttachFilesTrait;

    public function index()
    {
        // Get a new Query Builder instance for the `Invoice` model
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

        // The code then passes the paginated Invoices data to a view file called 'index' located in the 'page.backend.Invoices' directory, using the Laravel "compact" helper function.
        return view('page.backend.Invoices.index', compact('Incoices'));
    }

    public function create()
    {
        // The following code is creating an associative array $date, that stores the result of several function calls.
        $date['Clients'] = getClientsforInvoice();
        $date['currencies'] = getCurrency();
        $date['Product'] = getProductforInvoice();
        $date['Tax'] = getTaxforInvoice();

        // The return statement then outputs a view and passes the $date array as data to the view.
        return view('page.backend.Invoices.create', $date);
    }


    public function store($request)
    {
        // This code begins a new database transaction using Laravel's DB class.
        DB::beginTransaction();

        try {
            // Set up a new Invoice object to write to the database.
            $invoice = new Invoice();

            // Set various fields of the invoice from the incoming $request object.
            $invoice->client_id = $request->client_id;
            $invoice->invoice_number = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->due_date = $request->due_date;
            $invoice->status = $request->status;
            $invoice->value_status = 1;
            $invoice->currency = $request->currency;
            $invoice->product_id = $request->product_id;
            $invoice->quantity = $request->quantity;
            $invoice->unit_price = $request->unit_price;
            $invoice->amount_commission = $request->amount_commission;
            $invoice->discount = $request->discount;
            $invoice->tax_id = $request->tax_id;
            $invoice->value_vat = $request->value_vat;
            $invoice->amount = $request->amount;
            $invoice->created_by = Auth::user()->name;

            // Save the new invoice to the database.
            $invoice->save();

            // Get the ID of the newly created invoice and use it to set up a new Invoice_statu object.
            $invoice_Id = getInvoiceId();
            $invoiceStatus = new Invoice_statu();
            $invoiceStatus->invoice_id =  $invoice_Id;
            $invoiceStatus->status = 'يعالج';
            $invoiceStatus->value_status = 1;
            $invoiceStatus->created_by = Auth::user()->name;
            $invoiceStatus->save();

            // Using the same invoice ID, set up an Invoice_attachment object to store any photo attachments.
            $invoiceIdAttachments =  getInvoiceId();
            $invoiceAttachments = new Invoice_attachment();
            $invoiceAttachments->invoices_numbers = $request->invoice_number;
            $invoiceAttachments->created_by = Auth::user()->name;
            $invoiceAttachments->invoice_id =   $invoiceIdAttachments;

            // If the photo file was uploaded with the request, save it to disk and link it to the invoice_attachment in the database.
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $invoiceAttachments->photo = $photo;
                $this->uploadFile($request, 'photo', 'Invoice-Attachments');
            }

            // Save the invoice_attachment object to the database.
            $invoiceAttachments->save();

            $user = User::get(); //send notify all users
            //  $user = User::find(Auth::user()->id);//send notify all users
            $invoiceId = Invoice::latest()->first();

            // The following line of code creates a new invoice and notifies the user associated with the invoice
            // assuming $user and $invoiceId variables are already defined
            Notification::send($user, new InvoiceCreate($invoiceId)); //sent notify to for many user
            //$invoiceId->$user->notify(new InvoiceCreate($invoiceId)); //sent notify to one user

            // Commit the transaction changes and provide a successful alert message.
            DB::commit();


            successAlert();

            // Redirect the user to the invoices index page.
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            // If there is an error during the transaction, roll it back and show an error message.
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //Insert invoice Attachments
    public function insertAttachments($request)
    {
        //Variables specific tp Invoice Attachments
        $Request_Invoice_Id = $request->invoice_id;
        $Request_Invoice_Number = $request->invoices_numbers;
        $Request_Created_By = Auth::user()->name;

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

    public function show($id)
    {
        // This code generates a view to display a specific invoice's data on a Laravel application

        // Retrieve an instance of the specified invoice object based on the given ID
        $invoice = getInvoice($id); // Retrieves an instance of the invoice object being displayed based on ID parameter

        // Retrieve any attachments associated with the invoice and store them in $idInvoiceAttachments
        $idInvoiceAttachments = Invoice_attachment::where('invoice_id', $id)->get(); // Uses Eloquent ORM to retrieve all attachment records related to this invoice from the database

        // Render a view for the user to display the invoice data, passing in the retrieved $invoice and $idInvoiceAttachments as parameters
        return view('page.backend.Invoices.show', compact('invoice', 'idInvoiceAttachments'));
    }

    public function edit($id)
    {
        // This code generates a view for editing invoice data on a Laravel application

        // Populate an array with the necessary data needed to create the view, including lists of clients, available currencies, products, taxes, and an instance of the invoice object to be updated 
        $date['Clients'] = getClientsforInvoice(); // Retrieves a list of client objects from some source, likely a database
        $date['currencies'] = getCurrency(); // Retrieves a list of available currency options from some source
        $date['Product'] = getProductforInvoice(); // Retrieves a list of product objects from some source, likely a database
        $date['Tax'] = getTaxforInvoice(); // Retrieves a list of tax objects from some source, likely a database
        $date['Invoice'] = getInvoice($id); // Retrieves an instance of the invoice object being edited based on ID

        // Render a view for the user to edit the invoice data, passing in the $date array as a parameter
        return view('page.backend.Invoices.edit', $date);
    }

    public function update($request)
    {
        // This code attempts to update an invoice record in a Laravel application

        try {

            // Get the invoice object using `getInvoice()` method and its ID
            $invoice = getInvoice($request->id);

            // Update the relevant fields of the invoice object with data from the request object
            $invoice->client_id = $request->client_id;
            $invoice->invoice_number = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->due_date = $request->due_date;
            $invoice->status = $request->status;
            $invoice->value_status = 1;
            $invoice->currency = $request->currency;
            $invoice->product_id = $request->product_id;
            $invoice->quantity = $request->quantity;
            $invoice->unit_price = $request->unit_price;
            $invoice->amount_commission = $request->amount_commission;
            $invoice->discount = $request->discount;
            $invoice->tax_id = $request->tax_id;
            $invoice->value_vat = $request->value_vat;
            $invoice->amount = $request->amount;
            $invoice->created_by = Auth::user()->name;

            // Save the updated invoice record to the database
            $invoice->save();

            // Redirect the user to the index page for invoices, with an alert message indicating the success of the update operation
            updateAlert();
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {

            // If an exception occurs during the update process, redirect the user back to the previous page with an error message detailing the exception 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        // This code handles the deletion of an invoice in the context of a Laravel application

        // Retrieve the ID of the invoice to be deleted from the request
        $id = $request->id;

        // Find the invoice in the database by its ID or fail if it does not exist
        $invoice_Id = invoice::findOrfail($id);

        // Retrieve the first attachment for the invoice with the specified ID, if one exists
        $invoice_Attachments = Invoice_attachment::where('invoice_id', $request->id)->first();

        // Retrieve the page ID from the request
        $id_Page = $request->id_page;

        // Check if the page ID is not equal to 2
        if (!$id_Page == 2) {

            // If an invoice attachment exists for this invoice, delete it using the `deleteinvoiceAttachments()` function and the `$request->photo` parameter 
            if (!empty($invoice_Attachments->invoices_numbers)) {
                $this->deleteinvoiceAttachments($request->photo);
            }

            // Permanently delete the invoice from the database
            $invoice_Id->forceDelete();

            // Call the `deleteAlert()` function 

            deleteAlert();

            // Redirect back to the current page
            return redirect()->back();
        } else {  // If the page ID is equal to 2...

            // Soft delete the invoice from the database
            $invoice_Id->delete();

            // Display a success message using the Laravel Toastr package
            toastr()->success('تم النقل الى الارشيف,العملية ناجحة.');

            // Redirect back to the current page
            return redirect()->back();
        }
    }

    public function invoicePrint($id)
    {
        // This code retrieves an invoice record from the database based on its ID and passes it to a view for display

        $invoice = Invoice::where('id', $id)->first(); // Retrieve a single invoice record from the database based on the provided ID

        // Pass the retrieved invoice data to a view called 'invoicePrint' located in the 'page.backend.Invoices' directory
        return view('page.backend.Invoices.invoicePrint', compact('invoice'));
    }

    public function invoiceAll()
    {
        // This code generates a PDF file of invoice data using the mpdf library, Laravel framework, and Blade templating engine

        // Instantiate a new instance of the Mpdf class
        $mpdf = new Mpdf();

        // Retrieve all invoice data from the database
        $data  =  Invoice::all();

        // Render a blade template called 'pdf' located in the 'page.backend.Invoices' directory and pass the retrieved invoice data as an associative array with the key 'data'
        $view  = view('page.backend.Invoices.PDF.exportinvoice', compact('data'))->render();

        // Write the rendered blade template to the mpdf object for PDF generation
        $mpdf->WriteHTML($view);

        // Output the generated PDF file to the browser with filename 'invoice.pdf' and download option enabled
        $mpdf->Output('invoice.pdf', 'D');
    }

    public function readAllNotify($request)
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }

    public function notifications()
    {
        return view('page.backend.Invoices.notification.index');
    }
}
