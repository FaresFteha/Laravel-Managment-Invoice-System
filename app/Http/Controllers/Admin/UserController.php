<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:المستخدمين', ['only' => ['index']]);
        $this->middleware('permission:اضافة المستخدمين', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل المستخدمين', ['only' => ['edit', 'update']]);
        $this->middleware('permission:عرض المستخدمين', ['only' => ['show']]);
        $this->middleware('permission:حذف المستخدمين', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        // This code fetches users from the database table 'users' in descending order of their ids 
        // and paginates the result, showing 5 records per page.
        $search = \request()->input('keyword');
        $data = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        // This code sends the $data variable to the 'users.index' view as an array with two keys:
        // 'data' - which contains the paginated user records
        return view('page.backend.Admin.users.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Retrieve all roles from the "roles" table, sorted by name in ascending order
        $roles = Role::pluck('name', 'name')->all();

        // Pass the roles array to the "users.create" view using compact()
        return view('page.backend.Admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation of user input using Laravel's in-built validation method
        $request->validate([
            'name' => 'required', // Name field is required
            'email' => 'required|email|unique:users,email', // Email field is required, must be a valid email and should be unique for each user
            'password' => 'required|same:confirm-password', // Password field is required and should match the confirm password field
            'roles_name' => 'required' // The user role is required 
        ]);

        // Get all the user inputs
        $input = $request->all();

        // Hash the password before saving it to the database for security reasons
        $input['password'] = Hash::make($input['password']);

        // Create a new user with the provided input data
        $user = User::create($input);

        // Assign the role to the newly created user
        $user->assignRole($request->input('roles_name'));

        // Redirect the user to the users index page with a success message
        toastr()->success('تم اضافة المستخدم,العملية ناجحة.');
        return redirect()->route('users.index');
        // ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('page.backend.Admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // Finds the user with the given $id using the User model and assigns it to the $user variable
        $user = User::find($id);

        // Retrieves all the roles from the Role model and creates an array of role names.
        $roles = Role::pluck('name', 'name')->all();

        // Gets the roles assigned to the user with the given $id using the $user object and creates an array of role names.
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Returns the 'users.edit' view, passing in the $user, $roles, and $userRole variables as compact arrays.
        return view('page.backend.Admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // Validate the request data and define validation rules for each field
        $request->validate([
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                // Make sure email address is unique, except for the user with the given ID
                Rule::unique('users', 'email')->ignore($id)
            ],
            'password' => 'required|same:confirm-password', // Password field is required and should match the confirm password field

            'roles_name' => ['required'] // Make sure at least one role is selected
        ]);

        // Get all input from the request, including name, email, password, and roles
        $input = $request->all();

        // If a new password has been entered, hash it before updating the user object
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']); // Otherwise, remove the password from the input array
        }

        // Find the user with the given ID and update their attributes with the new input values
        $user = User::findOrFail($id);
        $user->update($input);

        // Remove any existing roles for this user in the model_has_roles table
        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        // Assign the selected roles to the user
        $user->assignRole($request->input('roles_name'));

        // Redirect back to the index page with a success message
        toastr()->success('تم تعديل المستخدم,العملية ناجحة.');
        return redirect()->route('users.index');
        // ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::find($id)->delete();
        toastr()->success('تم حذف المستخدم,العملية ناجحة.');
        return redirect()->route('users.index');
        // ->with('success', 'User deleted successfully');
    }
}
