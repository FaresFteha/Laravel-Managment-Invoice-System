<?php

namespace App\Repository;


use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\AttachFilesTrait;
use App\RepositoryInterface\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    //Traits
    use AttachFilesTrait;
    public function index()
    {
        // The following code initializes a variable called $Clients and uses the paginate() function to retrieve 10 client records at a time from the database.
        $Clients = Client::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            // ->when(\request()->status != null, function ($query) {
            //     $query->whereOrderStatus(\request()->status);
            // })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        // The view() function is used to render the index.blade.php view file under the page.backend.Clients directory, and passes in the $Clients variable as a parameter using Laravel's compact() function.
        return view('page.backend.Clients.index', compact('Clients'));
    }

    public function create()
    {
        // The following code initializes a variable called $countries by calling the getCountry() function. This function likely retrieves and returns an array of country data.

        $countries = getCountry();

        // The view() function is used to render the create.blade.php view file under the page.backend.Clients directory, and passes in the $countries variable as a parameter using Laravel's compact() function.
        return view('page.backend.Clients.create', compact('countries'));
    }

    public function store($request)
    {
        try {

            // Create a new instance of the Client model
            $Client = new Client();

            // Assign values to various properties of the Client model based on the data received in the request object
            $Client->first_name = $request->first_name;
            $Client->last_name = $request->last_name;
            $Client->email = $request->email;
            $Client->phone = $request->phone;
            $Client->password =  Hash::make($request->password);
            $Client->country_id = $request->country_id;
            $Client->state_id = $request->state_id;
            $Client->city_id = $request->city_id;
            $Client->postal_code = $request->postal_code;
            $Client->address = $request->address;

            // Check if a file was uploaded with the form and update the `photo` property of the Client model accordingly 
            if ($request->hasFile('photo')) {
                $this->deleteFile($Client->photo); // Delete any previously uploaded photo
                $photo = $request->file('photo')->getClientOriginalName();
                $Client->photo = $photo;
                $this->uploadFile($request, 'photo', 'Client-Attachments'); // Upload the latest photo to the server
            }

            // Save the new Client object to the database
            $Client->save();

            // Display a success message using the successAlert() function
            successAlert();

            // Redirect the user to the clients.index page
            return redirect()->route('clients.index');
        } catch (\Exception $e) {

            // If an exception is caught, redirect the user back to the previous page with an error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        // Get the client with the specified id using the `getClient()` function and assign it to the `$Client` variable
        $Client = getClient($id);

        $Incoices = Invoice::where('client_id', $id)->paginate(10);
        // Render the `show` view for the Clients page, passing the `$Client` variable along as a parameter to the view.
        return view('page.backend.Clients.show', compact('Client', 'Incoices'));
    }

    public function edit($id)
    {
        $Client = getClient($id);

        // Get the client with the specified id using the `getClient()` function and assign it to the `$Client` variable

        $countries = getCountry();

        // Retrieve a list of all countries using the `getCountry()` function and assign it to the `$countries` variable.

        return view('page.backend.Clients.edit', compact('Client', 'countries'));

        // Render the `edit` view for the Clients page, passing both `$Client` and `$countries` variables along as parameters to the view.

    }

    public function update($request)
    {
        try {
            $Client = Client::findorFail($request->id);
            // Find the Client with the specified id using the `findOrFail()` static method and assign it to the `$Client` variable.
            if (!empty($request->password)) {
                $Client->first_name = $request->first_name;
                $Client->last_name = $request->last_name;
                $Client->email = $request->email;
                $Client->phone = $request->phone;
                $Client->country_id = $request->country_id;
                $Client->state_id = $request->state_id;
                $Client->city_id = $request->city_id;
                $Client->postal_code = $request->postal_code;
                $Client->address = $request->address;
                $Client->password =  Hash::make($request->password);
                // Update the properties of the `$Client` object based on the form data received via the `$request` parameter.

                if ($request->hasFile('photo')) {
                    // Check if a photo was uploaded through the request via the `hasFile()` method.

                    $this->deleteFile($Client->photo);
                    // Delete the previously uploaded photo file from the server using the `deleteFile()` function.

                    $photo = $request->file('photo')->getClientOriginalName();
                    $Client->photo = $photo;
                    // Retrieve the name of the new photo file that was uploaded via the request using the `getClientOriginalName()` method,
                    // then assign it to the `$Client->photo` property to store it in the database.

                    $this->uploadFile($request, 'photo', 'Client-Attachments');
                    // Upload the new photo file to the server using the `uploadFile()` function.
                    // Save the updated `$Client` object to the database.
                }
                $Client->save();
            } else {
                $Client->first_name = $request->first_name;
                $Client->last_name = $request->last_name;
                $Client->email = $request->email;
                $Client->phone = $request->phone;
                $Client->country_id = $request->country_id;
                $Client->state_id = $request->state_id;
                $Client->city_id = $request->city_id;
                $Client->postal_code = $request->postal_code;
                $Client->address = $request->address;
                if ($request->hasFile('photo')) {
                    // Check if a photo was uploaded through the request via the `hasFile()` method.

                    $this->deleteFile($Client->photo);
                    // Delete the previously uploaded photo file from the server using the `deleteFile()` function.

                    $photo = $request->file('photo')->getClientOriginalName();
                    $Client->photo = $photo;
                    // Retrieve the name of the new photo file that was uploaded via the request using the `getClientOriginalName()` method,
                    // then assign it to the `$Client->photo` property to store it in the database.

                    $this->uploadFile($request, 'photo', 'Client-Attachments');
                    // Upload the new photo file to the server using the `uploadFile()` function.
                    // Save the updated `$Client` object to the database.
               
                }
                $Client->save();
            }



            return redirect()->route('clients.index')->with('status', 'Client details updated successfully.');
            // Redirect the user to the Clients page and show a success message using the `session()` function.

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // If an exception occurs during the update process, redirect the user back to the form with an error message.
        }
    }

    public function destroy($request)
    {
        $this->deleteFile($request->photo);
        // Delete the photo file associated with the Client that is being deleted using the `deleteFile()` function and passing in the `$request->photo` parameter.

        Client::destroy($request->id);
        // Find and delete the Client record with the specified id from the database using the `destroy()` method of the `Client` model.

        deleteAlert();
        // Set a "Client deleted" alert to display on the Clients page by calling the `deleteAlert()` function.

        return redirect()->route('clients.index');
        // Redirect the user back to the Clients page after the deletion.

    }
}
