<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersMasjidController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user', ['only' => ['index']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('app.users-masjid.index', compact('users'));
    }

    public function create()
    {
        $listRoles = Role::pluck('name', 'name');
        return view('app.users-masjid.create', compact('listRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $user = User::create($request->all());
        $user->assignRole($request->role);

        return redirect()->route('user-masjid.index')->with('success', 'Berhasil menambahkan user baru');
    }

    public function edit($id)
    {
        $listRoles = Role::pluck('name', 'name');
        $user = User::find($id);
        return view('app.users-masjid.edit', compact('user', 'listRoles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user-masjid.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user-masjid.index')->with('success', 'Data berhasil dihapus');
    }
}
