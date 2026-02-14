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
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // create appointment
        $appointment = Appointment::create($validated);

        // attach services
        if ($request->has('services')) {
            $attachData = [];
            foreach ($request->services as $serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $attachData[$service->id] = [
                        'quantity' => 1, // default quantity
                        'unit_price' => $service->price,
                    ];
                }
            }
            $appointment->services()->attach($attachData);
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully');
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();

        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        // sync services
        $attachData = [];
        if ($request->has('services')) {
            foreach ($request->services as $serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $attachData[$service->id] = [
                        'quantity' => 1,
                        'unit_price' => $service->price,
                    ];
                }
            }
        }
        $appointment->services()->sync($attachData);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->services()->detach();
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
