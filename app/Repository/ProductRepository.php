<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Product;
use App\RepositoryInterface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    use AttachFilesTrait;
    public function index()
    {
        // Retrieve a list of Product records from the database.
        $products = Product::query()
            // If query parameter 'keyword' is present in the request object, use it to search for matching Products.
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            // Order the retrieved Product records in ASC or DESC order based on the 'sort_by' and 'order_by' query parameters passed in the request object. Defaults to ordering by ID in descending order if no sorting params are passed.
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            // Paginate the result set with 10 Products per page by default, unless a different limit is specified in the 'limit_by' query parameter.
            ->paginate(\request()->limit_by ?? 10);
        // Return a view displaying the paginated Product results to the user.
        return view('page.backend.Products.index', compact('products'));
    }

    public function create()
    {
        // Retrieve a list of categories for the Product's create form.
        $categories = getCategory();
        // Return a view displaying the categories to the user, using the 'create' view in the Products subdirectory of the backend page directory.
        return view('page.backend.Products.create', compact('categories'));
    }

    public function store($request)
    {
        try {
            // Instantiate a new instance of the Product model.
            $Product = new Product();

            // Assign properties to the new Product model instance based on user input from the request object.
            $Product->name = $request->name;
            $Product->code = $request->code;
            $Product->category_id = $request->category_id;
            $Product->unit_price = $request->unit_price;
            $Product->description = $request->description;

            // Check if a photo file was uploaded with the request, and if so, assign the filename to the Product model's `photo` property and upload the file to the 'Product-Attachments' directory.
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $Product->photo = $photo;
                $this->uploadFile($request, 'photo', 'Product-Attachments');
            }

            // Save the new Product model instance to the database.
            $Product->save();

            // Display a success alert message to the user.
            successAlert();

            // Redirect the user to the Products index page.
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            // If an exception is thrown during the above execution, catch it and redirect the user back to the form with the error message in the session.
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        // Call the `getProduct` function with the specified `$id` as a parameter, and assign the result to the `$products` variable.
        $products = getProduct($id);

        // Return a view called 'page.backend.Products.show', passing in the `$products` variable via compact like an array.
        return view('page.backend.Products.show', compact('products'));
    }

    public function edit($id)
    {
        // Call the `getProduct` function with the specified `$id` as a parameter, and assign the result to the `$products` variable.
        $products = getProduct($id);

        // Call the `getCategory` function and assign the result to the `$categories` variable.
        $categories = getCategory();

        // Return a view called 'page.backend.Products.edit', passing in both `$products` and `$categories` variables via compact like an array.
        return view('page.backend.Products.edit', compact('products', 'categories'));
    }

    public function update($request)
    {
        try {
            // Find a Product model instance by ID from the request and assign it to `$Product` variable.
            $Product = Product::findorFail($request->id);

            // Update the properties of `$Product` with values from `$request`.
            $Product->name = $request->name;
            $Product->code = $request->code;
            $Product->category_id = $request->category_id;
            $Product->unit_price = $request->unit_price;
            $Product->description = $request->description;

            // If a file named 'photo' was uploaded in the `$request`, delete existing photo, set new photo name, and upload the new photo to the server
            if ($request->hasFile('photo')) {
                $this->deleteProduct($Product->photo);
                $photo = $request->file('photo')->getClientOriginalName();
                $Product->photo = $photo;
                $this->uploadFile($request, 'photo', 'Product-Attachments');
            }

            // Save the updated `$Product` model instance to database
            $Product->save();

            // Alert user that the update was successful
            updateAlert();

            // Redirect user to the `products.index` route
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            // If an Exception occurs during the try block execution, redirect user to the previous URL,
            // with a validation error message indicating the reason of the exception occurred.
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        // Call the `deleteProduct()` method and pass in the value of 'photo' from `$request` to delete the file stored in the server.
        $this->deleteProduct($request->photo);

        // Delete a Product model instance by ID from the `$request`
        Product::destroy($request->id);

        // Alert user that the product was deleted
        deleteAlert();

        // Redirect the user to the `products.index` page after deletion
        return redirect()->route('products.index');
    }
}
