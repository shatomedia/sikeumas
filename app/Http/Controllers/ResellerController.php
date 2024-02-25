<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class ResellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user', ['only' => ['index']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resellers = Role::where('name', 'reseller')->first()->users;
        return view('reseller.index', compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reseller.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataUser = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $reseller = User::create($dataUser);
        $reseller->assignRole('reseller');

        return redirect()->route('resellers.index')->with('success', 'Reseller created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::role('reseller')->findOrFail($id);
        return view('reseller.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($dataUser);

        return redirect()->route('resellers.index')->with('success', 'Reseller updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('resellers.index')->with('success', 'Reseller deleted successfully');
    }
}
