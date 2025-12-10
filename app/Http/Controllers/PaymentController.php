<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PaymentManagement;   
use Carbon\Carbon;



class PaymentController extends Controller
{
    /**
     * Show the payment page and patient list
     */
    public function paymentPage(Request $request)
    {
        // Load ALL patients
            $patients = Patient::join('Users', 'Patient.UserID', '=', 'Users.UserID')
                ->select('Patient.PatientID', 'Users.FirstName', 'Users.LastName', 'Patient.Total')
                ->orderBy('Patient.PatientID')
                ->get();


        $selectedPatient = null;

        // If search is used
        if ($request->has('search_id') && $request->search_id !== null && $request->search_id !== '') {
        $selectedPatient = Patient::join('Users', 'Patient.UserID', '=', 'Users.UserID')
            ->select('Patient.*', 'Users.FirstName', 'Users.LastName')
            ->where('Patient.PatientID', $request->search_id)
            ->first();

        }

        return view('Users.Supervisor.payments', compact('patients', 'selectedPatient'));
    }

    /**
     * Apply a payment to a patient's balance
     */
   public function makePayment(Request $request)
{
    $request->validate([
        'patient_id' => 'required|integer',
        'amount'     => 'required|numeric|min:0',
    ]);

    $patient = Patient::find($request->patient_id);

    if (!$patient) {
        return redirect()->route('payment.page')
            ->with('error', 'Patient not found.');
    }

    // Reduce balance
    $patient->Total -= $request->amount;
    if ($patient->Total < 0) {
        $patient->Total = 0;
    }
    $patient->save();

    // Log payment record
    PaymentManagement::create([
        'PatientID' => $patient->PatientID,
        'Amount'    => $request->amount,
        'Status'    => 'payed'
    ]);

    return redirect()->route('payment.page')
        ->with('success', 'Payment updated successfully!');
}


    /**
     * Auto-increase billing (daily charges)
     */
    public function updateBilling()
    {
        $patients = Patient::all();

        foreach ($patients as $p) {
            $p->Total += 10; // daily fee example
            $p->save();
        }

        return back()->with('success', 'Billing updated for all patients!');
    }
}
