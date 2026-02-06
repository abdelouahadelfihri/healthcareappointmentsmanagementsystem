<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Doctor::create($validated);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor added successfully');
    }
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $doctor->update($validated);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor updated successfully');
    }
    public function ajaxStore(Request $request)
    {
        $doctor = Doctor::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return response()->json($doctor);
    }
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }
}