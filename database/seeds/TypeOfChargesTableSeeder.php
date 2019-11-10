<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	/**
		* type { 1 laboratory, medicationAndTreatment, room, intravenousFluid, others }
		* group of charges { 1 laboratory, medicine, supplies}
    	*/
        
		$rooms = [
			[
				'name'=> 'Ward',
				'price'=> 300,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 3,
				'group_of_charge_id'=> null,
				'user_id'=> 1
			],
			[
				'name'=> 'Semi-Private',
				'price'=> 500,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 3,
				'group_of_charge_id'=> null,
				'user_id'=> 1
			],
			[
				'name'=> 'Private',
				'price'=> 600,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 3,
				'group_of_charge_id'=> null,
				'user_id'=> 1
			]
		];

		// generate rooms charges
		$this->generateInitialData($rooms);

		$others = [
			[
				'name'=> 'EMERGENCY ROOM FEE',
				'price'=> 450,
				'is_default'=> 1,
				'parent_id'=> null,
				'type_id'=> 5,
				'group_of_charge_id'=> null,
				'user_id'=> 1
			],
			[
				'name'=> 'MISCELLANEOUS FEE',
				'price'=> 350,
				'is_default'=> 1,
				'parent_id'=> null,
				'type_id'=> 5,
				'group_of_charge_id'=> null,
				'user_id'=> 1
			]
		];

		// generate default charges
		$this->generateInitialData($others);

		$laboratories = [
			[
				'name'=> 'CBC/PC',
				'price'=> 250,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'RBS',
				'price'=> 180,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'FBS',
				'price'=> 150,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'UA',
				'price'=> 75,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'SE',
				'price'=> 75,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'S.ELECT',
				'price'=> 1200,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'TROP.I',
				'price'=> 1000,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'S.CREA',
				'price'=> 700,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'S.URIC ACID',
				'price'=> 750,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'BLOOD TYPING',
				'price'=> 250,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'THYPIDOT',
				'price'=> 750,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'PREG.TEST',
				'price'=> 750,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'HBSAG',
				'price'=> 900,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
			[
				'name'=> 'VDRL',
				'price'=> 750,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 1,
				'group_of_charge_id'=> 1,
				'user_id'=> 1
			],
		];

		// generate laboratory charges
		$this->generateInitialData($laboratories);

		$medicationAndTreatment = [
			[
				'name'=> 'PARACETAMOL (TAB)',
				'price'=> 10,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'PARACETAMOL (SYRUP)',
				'price'=> 60,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'PARACETAMOL (SUPP)',
				'price'=> 50,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'PARACETAMOL (VIAL)',
				'price'=> 100,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'AMPICILLIN (VIAL)',
				'price'=> 93,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'OMEPRAZOLE (VIAL)',
				'price'=> 200,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'OMEPRAZOLE (TAB)',
				'price'=> 97,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'CEFUROXIME (VIAL)',
				'price'=> 200,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'ZINC (DROPS)',
				'price'=> 145,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'SALBUTAMOL (NEB)',
				'price'=> 60,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'SALBU + IPRA (NEB)',
				'price'=> 150,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'BUDESONIDE (VIAL)',
				'price'=> 180,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'TRANEXAMIC ACID (AMPULE)',
				'price'=> 100,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'RANITIDINE (AMPULE)',
				'price'=> 150,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'RANITIDINE (TAB)',
				'price'=> 50,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'CITIRIZINE (TAB)',
				'price'=> 20,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'CITIRIZINE (SYRUP)',
				'price'=> 60,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'KETOANALOGUE (VIAL)',
				'price'=> 200,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'KETOROLAC (TAB)',
				'price'=> 50,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'CEFIXIME (SYRUP)',
				'price'=> 200,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'DOMPERIDONE (SYRUP)',
				'price'=> 490,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'DOMPERIDONE (TAB)',
				'price'=> 67,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'ANTACID (SYRUP)',
				'price'=> 160,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'LOSARTAN (TAB)',
				'price'=> 45,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'VITAMIN K (AMP)',
				'price'=> 110,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 2,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
		];

		// generate medication and treatment charges
		$this->generateInitialData($medicationAndTreatment);

		$intravenousFluid = [
			[
				'name'=> 'D5LR (500ml)',
				'price'=> 150,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'D5LR (1l)',
				'price'=> 160,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'D5.3NACL (500ml)',
				'price'=> 150,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'D5.3NACL (1l)',
				'price'=> 160,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'PLR (500ml)',
				'price'=> 160,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
			[
				'name'=> 'PLR (1l)',
				'price'=> 160,
				'is_default'=> 0,
				'parent_id'=> null,
				'type_id'=> 4,
				'group_of_charge_id'=> 2,
				'user_id'=> 1
			],
		];

		// generate medication and treatment charges
		$this->generateInitialData($intravenousFluid);

    }

    function generateInitialData($data) {
    	foreach ($data as $value) {
			DB::table('type_of_charges')->insert([
	            'name' => $value['name'],
	            'price' => $value['price'],
	            'is_default' => $value['is_default'],
	            'parent_id' => $value['parent_id'],
	            'type_id' => $value['type_id'],
	            'group_of_charge_id' => $value['group_of_charge_id'],
	            'user_id' => $value['user_id'],
	        ]);
		}
    }
}
