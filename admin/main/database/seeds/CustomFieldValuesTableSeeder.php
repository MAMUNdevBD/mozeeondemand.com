<?php

use Illuminate\Database\Seeder;

class CustomFieldValuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('custom_field_values')->delete();
        
        \DB::table('custom_field_values')->insert(array (
            0 => 
            array (
                'id' => 29,
                'value' => '+136 226 5669',
                'view' => '+136 226 5669',
                'custom_field_id' => 7,
                'customizable_type' => 'App\\Models\\User',
                'customizable_id' => 2,
                'created_at' => '2019-09-06 21:52:30',
                'updated_at' => '2019-09-06 21:52:30',
            ),
        ));
        
        
    }
}