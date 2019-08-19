<?php

namespace App\Http\Controllers\api;

use App\Billing;
use App\GroupOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::with(['typeOfCharge', 'patientRecord'])->get();

        return $billings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'type_of_charge_id' => 'required|not_in:0',
            'amount' => 'required|max:191',
            'quantity_and_days' => 'required|max:191|not_in:0',
            'description' => 'required|max:191',
        ]);

        $billing = new Billing;
        $billing->patient_record_id = $request->patient_record_id;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->amount = $request->amount;
        $billing->quantity_and_days = $request->quantity_and_days;
        $billing->total = $request->amount * $request->quantity_and_days;
        $billing->description = $request->description;
        $billing->user_id = \Auth::user()->id;
        $billing->save();

        return response()->json([
            'message' => 'success',
            'billing' => $billing->load(['typeOfCharge', 'patientRecord']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        return $billing->load(['typeOfCharge', 'patientRecord']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        return $billing;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        $validatedData = $request->validate([
            'patient_record_id' => 'required|not_in:0',
            'type_of_charge_id' => 'required|not_in:0',
            'amount' => 'required|max:191',
            'quantity_and_days' => 'required|max:191|not_in:0',
            'description' => 'required|max:191',
        ]);

        $billing->patient_record_id = $request->patient_record_id;
        $billing->type_of_charge_id = $request->type_of_charge_id;
        $billing->amount = $request->amount;
        $billing->quantity_and_days = $request->quantity_and_days;
        $billing->total = $request->amount * $request->quantity_and_days;
        $billing->description = $request->description;
        $billing->user_id = \Auth::user()->id;
        $billing->save();

        return response()->json([
            'message' => 'success',
            'billing' => $billing->load(['typeOfCharge', 'patientRecord']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display a listing of the resource by record.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataByRecord($patient_record_id)
    {
        $billings = Billing::with(['typeOfCharge', 'patientRecord'])
            ->where('patient_record_id', $patient_record_id)
            ->get();
        return $billings;
    }

    /**
     * Display a listing of the resource by record report.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($patient_record_id)
    {
        $billings = Billing::with([
            'typeOfCharge' => function($query) {
                $query->with([
                    'groupOfCharge'
                ]);
            }, 
            'patientRecord'
        ])->where('patient_record_id', $patient_record_id)
            ->get();

        $withoutGroupBill = Billing::with([
            'typeOfCharge' => function($query) {
                $query->with([
                    'groupOfCharge'
                ]);
            }, 
            'patientRecord'
        ])->whereHas('typeOfCharge', function($q) {
            $q->where('group_of_charge_id',null);
        })->where('patient_record_id', $patient_record_id)
            ->get();


        $laboratoryGroupBill = Billing::with([
            'typeOfCharge' => function($query) {
                $query->with([
                    'groupOfCharge'
                ]);
            }, 
            'patientRecord'
        ])->whereHas('typeOfCharge', function($q) {
            $q->where('group_of_charge_id', 1);
        })->where('patient_record_id', $patient_record_id)
            ->get();

        $medicineGroupBill = Billing::with([
            'typeOfCharge' => function($query) {
                $query->with([
                    'groupOfCharge'
                ]);
            }, 
            'patientRecord'
        ])->whereHas('typeOfCharge', function($q) {
            $q->where('group_of_charge_id', 2);
        })->where('patient_record_id', $patient_record_id)
            ->get();

        $suppliesGroupBill = Billing::with([
            'typeOfCharge' => function($query) {
                $query->with([
                    'groupOfCharge'
                ]);
            }, 
            'patientRecord'
        ])->whereHas('typeOfCharge', function($q) {
            $q->where('group_of_charge_id', 3);
        })->where('patient_record_id', $patient_record_id)
            ->get();

        $patientRecord = \App\PatientRecord::with([
            'user',
            'patient',
            'disposition',
            'result',
            'philhealthMembership',
            'admitAndCheckBy',
            'dischargedBy',
            'physician',
            'chartCompletedBy',
            'patientRooms',
            'currentRoom',
            'currentDiagnose',
            'rooms',
            'patientInsurances',
            'patientDiscounts'
        ])->where('id', $patient_record_id)
        ->first();

        $patient = \App\Patient::where('id', $patientRecord->patient->id)->first();

        $totalBill = $billings->sum('total');

        $totalDiscount = ($totalBill * 0.70) * $patientRecord->patientDiscounts->sum('amount');

        $totalHMO = $patientRecord->patientInsurances->sum('amount');

        $grandTotal = $totalBill - ($totalDiscount + $totalHMO);

        return [
            'billings' => $billings,
            'withoutGroupBill' => $withoutGroupBill,

            'laboratoryGroupBill' => $laboratoryGroupBill,
            'laboratoryGroupBillTotal' => $laboratoryGroupBill->sum('total'),

            'medicineGroupBill' => $medicineGroupBill,
            'medicineGroupBillTotal' => $medicineGroupBill->sum('total'),

            'suppliesGroupBill' => $suppliesGroupBill,
            'suppliesGroupBillTotal' => $suppliesGroupBill->sum('total'),
            
            'totalBill' => number_format($totalBill, 2),
            'patient' => $patient,
            'patientRecord' => $patientRecord,
            'totalDiscount' => number_format($totalDiscount, 2),
            'totalHMO' => number_format($totalHMO, 2),
            'grandTotal' => number_format($grandTotal, 2)
        ];
    }
}
