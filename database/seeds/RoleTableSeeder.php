<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                // user
                'create-user' => true,
                'view-user' => true,
                'update-user' => true,
                'delete-user' => true,
                // patient
                'create-patient' => true,
                'view-patient' => true,
                'update-patient' => true,
                'delete-patient' => true,
                // record
                'create-patientRecord' => true,
                'view-patientRecord' => true,
                'update-patientRecord' => true,
                'delete-patientRecord' => true,
                // patient room
                'create-patientRoom' => true,
                'view-patientRoom' => true,
                'update-patientRoom' => true,
                'delete-patientRoom' => true,
                // nurse note
                'create-nurseNote' => true,
                'view-nurseNote' => true,
                'update-nurseNote' => true,
                'delete-nurseNote' => true,
                // medicationAndTreatment
                'create-medicationAndTreatment' => true,
                'view-medicationAndTreatment' => true,
                'update-medicationAndTreatment' => true,
                'delete-medicationAndTreatment' => true,
                // vitalSign
                'create-vitalSign' => true,
                'view-vitalSign' => true,
                'update-vitalSign' => true,
                'delete-vitalSign' => true,
                // intravenousFluid
                'create-intravenousFluid' => true,
                'view-intravenousFluid' => true,
                'update-intravenousFluid' => true,
                'delete-intravenousFluid' => true,
                // doctorsOrder
                'create-doctorsOrder' => true,
                'view-doctorsOrder' => true,
                'update-doctorsOrder' => true,
                'delete-doctorsOrder' => true,
                // laboratory
                'create-laboratory' => true,
                'view-laboratory' => true,
                'update-laboratory' => true,
                'delete-laboratory' => true,
                // patientDiagnoses
                'create-patientDiagnoses' => true,
                'view-patientDiagnoses' => true,
                'update-patientDiagnoses' => true,
                'delete-patientDiagnoses' => true,
                // billing
                'create-billing' => true,
                'view-billing' => true,
                'update-billing' => true,
                'delete-billing' => true,
                // room
                'create-room' => true,
                'view-room' => true,
                'update-room' => true,
                'delete-room' => true,
                // floor
                'create-floor' => true,
                'view-floor' => true,
                'update-floor' => true,
                'delete-floor' => true,
                // diagnoses
                'create-diagnoses' => true,
                'view-diagnoses' => true,
                'update-diagnoses' => true,
                'delete-diagnoses' => true,
                // typeOfCharge
                'create-typeOfCharge' => true,
                'view-typeOfCharge' => true,
                'update-typeOfCharge' => true,
                'delete-typeOfCharge' => true,
                // discount
                'create-discount' => true,
                'view-discount' => true,
                'update-discount' => true,
                'delete-discount' => true,
                // insurance
                'create-insurance' => true,
                'view-insurance' => true,
                'update-insurance' => true,
                'delete-insurance' => true,
                // patientDiscount
                'create-patientDiscount' => true,
                'view-patientDiscount' => true,
                'update-patientDiscount' => true,
                'delete-patientDiscount' => true,
                // patientInsurance
                'create-patientInsurance' => true,
                'view-patientInsurance' => true,
                'update-patientInsurance' => true,
                'delete-patientInsurance' => true,
            ]
        ]);
        
        $nurse = Role::create([
            'name' => 'Nurse', 
            'slug' => 'nurse',
            'permissions' => [
                // patient
                'create-patient' => true,
                'view-patient' => true,
                'update-patient' => true,
                'delete-patient' => true,
                // record
                'create-patientRecord' => true,
                'view-patientRecord' => true,
                'update-patientRecord' => true,
                'delete-patientRecord' => true,
                // patient room
                'create-patientRoom' => true,
                'view-patientRoom' => true,
                'update-patientRoom' => true,
                'delete-patientRoom' => true,
                // nurse note
                'create-nurseNote' => true,
                'view-nurseNote' => true,
                'update-nurseNote' => true,
                'delete-nurseNote' => true,
                // medicationAndTreatment
                'create-medicationAndTreatment' => true,
                'view-medicationAndTreatment' => true,
                'update-medicationAndTreatment' => true,
                'delete-medicationAndTreatment' => true,
                // vitalSign
                'create-vitalSign' => true,
                'view-vitalSign' => true,
                'update-vitalSign' => true,
                'delete-vitalSign' => true,
                // intravenousFluid
                'create-intravenousFluid' => true,
                'view-intravenousFluid' => true,
                'update-intravenousFluid' => true,
                'delete-intravenousFluid' => true,
                // doctorsOrder
                'view-doctorsOrder' => true,
                // laboratory
                'create-laboratory' => true,
                'view-laboratory' => true,
                'update-laboratory' => true,
                'delete-laboratory' => true,
                // patientDiagnoses
                'create-patientDiagnoses' => true,
                'view-patientDiagnoses' => true,
                'update-patientDiagnoses' => true,
                'delete-patientDiagnoses' => true,
            ]
        ]);
        
        $doctor = Role::create([
            'name' => 'Doctor', 
            'slug' => 'doctor',
            'permissions' => [
                // patient
                'view-patient' => true,
                // record
                'create-patientRecord' => true,
                'view-patientRecord' => true,
                'update-patientRecord' => true,
                'delete-patientRecord' => true,
                // patient room
                'view-patientRoom' => true,
                // nurse note
                'view-nurseNote' => true,
                // medicationAndTreatment
                'view-medicationAndTreatment' => true,
                // vitalSign
                'view-vitalSign' => true,
                // intravenousFluid
                'view-intravenousFluid' => true,
                // doctorsOrder
                'create-doctorsOrder' => true,
                'view-doctorsOrder' => true,
                'update-doctorsOrder' => true,
                'delete-doctorsOrder' => true,
                // laboratory
                'view-laboratory' => true,
                // patientDiagnoses
                'create-patientDiagnoses' => true,
                'view-patientDiagnoses' => true,
                'update-patientDiagnoses' => true,
                'delete-patientDiagnoses' => true,
            ]
        ]);

        $staff = Role::create([
            'name' => 'staff', 
            'slug' => 'staff',
            'permissions' => [
                // patient
                'view-patient' => true,
                // record
                'view-patientRecord' => true,
                // patient room
                'view-patientRoom' => true,
                // medicationAndTreatment
                'view-medicationAndTreatment' => true,
                // laboratory
                'view-laboratory' => true,
                // patientDiagnoses
                'view-patientDiagnoses' => true,
                // billing
                'create-billing' => true,
                'view-billing' => true,
                'update-billing' => true,
                'delete-billing' => true,
                // room
                'view-room' => true,
                // floor
                'view-floor' => true,
                // diagnoses
                'view-diagnoses' => true,
                // typeOfCharge
                'view-typeOfCharge' => true,
                // discount
                'view-discount' => true,
                // insurance
                'view-insurance' => true,
                // patientDiscount
                'create-patientDiscount' => true,
                'view-patientDiscount' => true,
                'update-patientDiscount' => true,
                'delete-patientDiscount' => true,
                // patientInsurance
                'create-patientInsurance' => true,
                'view-patientInsurance' => true,
                'update-patientInsurance' => true,
                'delete-patientInsurance' => true,
            ]
        ]);

        $billing = Role::create([
            'name' => 'billing', 
            'slug' => 'billing',
            'permissions' => [
               // billing
               'create-billing' => true,
               'view-billing' => true,
               'update-billing' => true,
               'delete-billing' => true,
               // discount
               'create-discount' => true,
               'view-discount' => true,
               'update-discount' => true,
               'delete-discount' => true,
               // insurance
               'create-insurance' => true,
               'view-insurance' => true,
               'update-insurance' => true,
               'delete-insurance' => true,
               // patientDiscount
               'create-patientDiscount' => true,
               'view-patientDiscount' => true,
               'update-patientDiscount' => true,
               'delete-patientDiscount' => true,
               // patientInsurance
               'create-patientInsurance' => true,
               'view-patientInsurance' => true,
               'update-patientInsurance' => true,
               'delete-patientInsurance' => true,
            ]
        ]);
    }
}
