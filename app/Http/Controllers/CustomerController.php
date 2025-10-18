<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('customers.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
         'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:customers,email',
        'phone' => [
            'nullable',
            'string',
            'min:10',
            'max:20',
            'regex:/^[\+]?[\d\s\-\(\)]+$/'
        ],
        'address' => 'nullable|string|max:500',
    ], [
        'phone.regex' => 'Phone number must contain only digits, spaces, hyphens, parentheses, and optional + sign.',
        'phone.min' => 'Phone number must be at least 10 characters.',
    ]);
        $validated = $request->only(['name', 'email', 'phone', 'address']);
        Customer::create($validated);

        return redirect()->route('customers.index')
                     ->with('success', 'Customer created successfully.');
        //
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
    return view('customers.edit', compact('customer'));
}

public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);
    $customer->update($request->except('_token', '_method'));

    return redirect()->route('customers.index')
                     ->with('success', 'Customer updated successfully.');
}
        //
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect()->route('customers.index')
                     ->with('success', 'Customer deleted successfully.');
}}