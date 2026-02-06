<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor', 'services'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        return view('appointments.create', compact('patients', 'doctors', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ]);

        Appointment::create($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment created successfully');
    }
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        $appointment->load('services');
        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'services'));
    }
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string|max:1000',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $appointment->update(collect($validated)->except('services')->toArray());

        if (isset($validated['services'])) {
            $appointment->services()->sync($validated['services']);
        } else {
            $appointment->services()->detach();
        }

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully');
    }
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}