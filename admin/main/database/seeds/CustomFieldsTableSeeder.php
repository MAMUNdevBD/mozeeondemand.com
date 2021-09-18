<?php

use Illuminate\Database\Seeder;

class CustomFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        
        \DB::table('custom_fields')->insert(array (
                    'id' => 7,
                    'name' => 'verifiedPhone',
                    'type' => 'text',
                    'values' => NULL,
                    'disabled' => 1,
                    'required' => 0,
                    'in_table' => 0,
                    'bootstrap_column' => 6,
                    'order' => 3,
                    'custom_field_model' => 'App\\Models\\User',
                    'created_at' => '2019-09-06 21:49:22',
                    'updated_at' => '2019-09-06 21:49:22',
        ));
        
        
    }
}
