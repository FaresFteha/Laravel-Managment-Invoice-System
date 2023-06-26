<?php

namespace App\Repository;

use App\Models\Tax;
use App\RepositoryInterface\TaxRepositoryInterface;

class TaxRepository implements TaxRepositoryInterface
{
    public function index()
    {
        // Query the `Tax` model's database table and retrieve all records based on certain parameters.
        // If a "keyword" exists in the request, search for it using the `search()` function.
        // Sort the results by the specified column with the specified order (either ascending or descending).
        // Paginate the results so that only a certain number of records are returned per page.
        $tax = Tax::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        // Return the Taxes index page (view), passing in the `$tax` parameter to be used in the view.
        return view('page.backend.Taxes.index', compact('tax'));
    }

    public function store($request)
    {
        // Try block for handling potential exceptions thrown by the code inside it.
        try {
            // Calls the function to validate the tax data and throws an exception if validation fails.
            validateTax($request);
            // If validation succeeds, creates a new Tax instance using the data sent in the request.
            Tax::create($request->all());
            // Shows a success alert message to the user.
            successAlert();
            // Redirects the user to the taxes index page.
            return redirect()->route('taxes.index');
        } catch (\Exception $e) { // Catches any exceptions thrown in the try block
            // Redirects the user back to the previous page with an error message containing the caught exception's message.
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        // Try block for handling potential exceptions thrown by the code inside it.
        try {
            // Calls the function to validate the tax data and throws an exception if validation fails.
            validateTax($request);
            // Finds the Tax record with the ID specified in the request.
            $taxes = Tax::find($request->id);
            // Updates the found Tax record with the new data sent in the request.
            $taxes->update($request->all());
            // Shows an update success alert message to the user.
            updateAlert();
            // Redirects the user to the taxes index page.
            return redirect()->route('taxes.index');
        } catch (\Exception $e) { // Catches any exceptions thrown in the try block
            // Redirects the user back to the previous page with an error message containing the caught exception's message.
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        // Deletes a Tax record from the database with the ID specified in the request.
        Tax::destroy($request->id);
        // Shows a success message to the user indicating that the Tax record was deleted.
        deleteAlert();
        // Redirects the user to the taxes index page after deletion is completed.
        return redirect()->route('taxes.index');
    }
}
