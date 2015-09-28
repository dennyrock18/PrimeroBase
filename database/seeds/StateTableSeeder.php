<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $states = array('Alabama (AL)', 'Alaska (AK)', 'Arizona (AZ)', 'Arkansas (AR)', 'California (CA)', 'Carolina del Norte (NC)',
            'Carolina del Sur (SC)', 'Colorado (CO)', 'Connecticut (CT)', 'Dakota del Norte (ND)', 'Dakota del Sur (SD)', 'Delaware (DE)',
            'Florida (FL)', 'Georgia (GA)', 'Hawái (HI)', 'Idaho (ID)', 'Illinois (IL)', 'Indiana (IN)', 'Iowa (IA)', 'Kansas (KS)', 'Kentucky (KY)',
            'Luisiana (LA)', 'Maine (ME)', 'Maryland (MD)', 'Massachusetts (MA)', 'Míchigan (MI)', 'Minnesota (MN)', 'Misisipi (MS)', 'Misuri (MO)',
            'Montana (MT)', 'Nebraska (NE)', 'Nevada (NV)', 'Nueva Jersey (NJ)', 'Nueva York (NY)', 'Nuevo Hampshire (NH)', 'Nuevo México (NM)',
            'Ohio (OH)', 'Oklahoma (OK)', 'Oregón (OR)', 'Pensilvania (PA)', 'Rhode Island (RI)', 'Tennessee (TN)', 'Texas (TX)', 'Utah (UT)', 'Vermont (VT)',
            'Virginia (VA)', 'Virginia Occidental (WV)', 'Washington (WA)', 'Wisconsin (WI)', 'Wyoming (WY)');

        foreach ($states as $state) {

            DB::table('states')->insert(array(
                'state' => $state
            ));
        }
    }
}
