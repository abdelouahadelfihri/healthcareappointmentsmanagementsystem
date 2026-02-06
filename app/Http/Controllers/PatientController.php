<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email'
        ]);

        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient added successfully');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email'
        ]);

        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully');
    }
    public function ajaxStore(Request $request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return response()->json($patient);
    }
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully');
    }
}