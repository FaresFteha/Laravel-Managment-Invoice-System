<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Unique;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:الادوار', ['only' => ['index']]);
        $this->middleware('permission:اضافة الادوار', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الادوار', ['only' => ['edit', 'update']]);
        $this->middleware('permission:عرض الادوار', ['only' => ['show']]);
        $this->middleware('permission:حذف الادوار', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $search = \request()->input('keyword');
        $roles = Role::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        $i = ($request->input('page', 1) - 1) * 5;
        return view('page.backend.Admin.roles.index', [
            'roles' => $roles,
            'i' => $i
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permission = Permission::get();
        return view('page.backend.Admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // This code validates the incoming request to ensure that the 'name' and 'permission' fields are present
        // The 'name' field is also validated against the 'roles' table to ensure that it is unique 
        $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')],
            'permission' => ['required'],
        ]);

        // Create a new Role instance with the 'name' field set to the value of the input 'name' from the request
        $role = Role::create(['name' => $request->input('name')]);

        // Synchronize the permissions associated with the given role using the 'syncPermissions' method and the selected
        // permissions from the input 'permission' field
        $role->syncPermissions($request->input('permission'));

        // Return a redirect response to the 'roles.index' route with a success message added to the session
        toastr()->success('تم اضافة الدور,العملية ناجحة.');
        return redirect()->route('roles.index');
        // ->with('success', 'Role created successfully');
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
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('page.backend.Admin.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // This code retrieves the role with the specified ID from the 'roles' table using the 'find' method
        $role = Role::find($id);

        // Retrieve all permissions from the 'permissions' table using the 'get' method
        $permission = Permission::get();

        // Get the permissions associated with the given role by performing a database query to retrieve the permission IDs 
        // from the 'role_has_permissions' pivot table where the role ID matches the given ID. Then, return an associative 
        // array with the permission IDs as both keys and values.
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // Return a view named 'roles.edit' with three variables: $role (the role retrieved earlier), $permission (all available 
        // permissions), and $rolePermissions (an array of permission IDs for this specific role).
        return view('page.backend.Admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
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
        // Validate incoming request data
        $request->validate([
            'name' => 'required', // 'name' field is required and must not be empty
            'permission' => 'required', // 'permission' field is required and must not be empty
        ]);

        // Find the relevant role by its id
        $role = Role::find($id);

        // Update the role name with the value provided in the 'name' field of the request
        $role->name = $request->input('name');

        // Save the updated role to the database
        $role->save();

        // Synchronize the permissions for the role with those provided in the 'permission' field of the request
        $role->syncPermissions($request->input('permission'));

        // Redirect the user to the index page for roles, along with a success message indicating that the role was updated successfully
        toastr()->success('تم تعديل الدور,العملية ناجحة.');
        return redirect()->route('roles.index');
        //->with('success', 'Role updated successfully');
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
        Role::find($id)->delete();
        toastr()->success('تم حذف الدور,العملية ناجحة.');
        return redirect()->route('roles.index');
        //   ->with('success', 'Role deleted successfully');
    }
}
