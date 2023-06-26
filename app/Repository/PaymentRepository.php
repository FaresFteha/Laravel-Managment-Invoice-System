<?php

namespace App\Repository;

use Mpdf\Mpdf;
use App\Models\Invoice;
use App\Models\Payment;
use App\RepositoryInterface\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        // Retrieve all Invoice records from the database, paginated with 10 records per page
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

        // Render the index view and pass it a variable called $Incoices that contains the paginated Invoice records
        return view('page.backend.Invoices.InvoicePayment.index', compact('Incoices'));
    }


    public function create()
    {
        // Retrieve all Payment records from the database
        $payments = Payment::get();

        // Render the paymentsall view and pass it a variable called $payments that contains the retrieved Payment records
        return view('page.backend.Invoices.InvoicePayment.paymentsall', compact('payments'));
    }

    public function store($request)
    {
        try {
            //code...
            $invoice_Id = $request->id;
            $payment_total =  $request->amount - $request->payment_amount;

            // Create a new Payment instance
            $payment = new Payment();
            // Set the relevant properties of the Payment instance
            $payment->invoice_id = $invoice_Id;
            $payment->amount = $request->amount;
            $payment->payment_total =  $payment_total;
            $payment->payment_amount = $request->payment_amount;
            $payment->payment_date = $request->payment_date;
            $payment->payment_mode = $request->payment_mode;
            $payment->status = $request->status;
            $payment->created_by = 'Fares Fteha';
            // Save the new Payment instance to the database
            $payment->save();

            // Display a success message using toastr and redirect to the payment index page
            toastr()->success('تم دفع الفاتورة,العملية ناجحة.');
            return redirect()->route('payment.index');
        } catch (\Exception $e) {
            // If an error occurred during the database transaction, redirect back to the previous page and display the error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // Retrieve all Payment instances associated with a given invoice ID
        $payments = Payment::where('invoice_id', $id)->get();

        // Check if there are any payments retrieved from the database
        if (empty($payments)) {
            // If no payments were found, display an error message to the user using toastr
            toastr()->error('لا يوجد مدفوعات لهذه الفاتورة');

            // Redirect the user back to the previous page
            return redirect()->back();
        } else {
            // If payments were found, render the 'payments' view and pass the relevant data through compact()
            return view('page.backend.Invoices.InvoicePayment.payments', compact('payments'));
        }
    }

    public function update($request)
    {
        try {
            // The code inside this try block attempts to execute without errors

            // Getting invoice id and calculating payment_total
            $invoice_Id = $request->id;
            $payment_total =  $request->amount - $request->payment_amount;

            // Retrieving the Payment instance with the ID passed in the request, and updating its attributes
            $payment = Payment::findOrfail($request->id);
            $payment->amount = $request->amount;
            $payment->payment_total = $payment_total;
            $payment->payment_amount = $request->payment_amount;
            $payment->payment_date = $request->payment_date;
            $payment->payment_mode = $request->payment_mode;
            $payment->status = $request->status;
            $payment->created_by = 'Fares Fteha';

            // Saving the updated Payment instance to the database
            $payment->save();

            // Displaying a success message to the user using the toastr library
            toastr()->success('تم دفع الفاتورة,العملية ناجحة.');

            // Redirecting the user back to the previous page
            return redirect()->back();
        } catch (\Exception $e) {
            // If an Exception is thrown during execution inside the try block, it will be caught here
            // Any errors are stored in $e and returned to the user through the error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        // The Payment with the specified ID is deleted
        Payment::destroy($request->id);

        // A success message for the delete operation is displayed to the user
        deleteAlert();

        // Redirecting the user back to the previous page after successful deletion
        return redirect()->back();
    }

    public function incoicesPaymentExport()
    {
        // This code generates a PDF file of invoice data using the mpdf library, Laravel framework, and Blade templating engine

        // Instantiate a new instance of the Mpdf class
        $mpdf = new Mpdf();

        // Retrieve all Payment data from the database
        $payments = Payment::get();

        // Render a blade template called 'pdf' located in the 'page.backend.Invoices.PDF.exportinvoicepaymnet' directory and pass the retrieved payments data as an associative array with the key 'payments'
        $view  = view('page.backend.Invoices.PDF.exportinvoicepaymnet', compact('payments'))->render();

        // Write the rendered blade template to the mpdf object for PDF generation
        $mpdf->WriteHTML($view);

        // Output the generated PDF file to the browser with filename 'invoice.pdf' and download option enabled
        $mpdf->Output('payments.pdf', 'D');
    }

    public function payment_print($id)
    {
        $Payment = Payment::where('id', $id)->first();
        return view('page.backend.Invoices.InvoicePayment.paymentprint', compact('Payment'));
    }
}
