<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(base_path() . '/database/data/packages.csv', 'r');

        $header_row = true; // for skipping the first row, as it contains column names
        while (($row = fgetcsv($file, 0, ',')) != FALSE) {
            if ($header_row) { //first one is header row,
                $header_row = false;
                continue; //skip loop body, go to loop top to move next row
            }

            //insert now
            DB::table('packages')->insert([
                'type' => $row[0],
                'name' => $row[1],
                'price' => $row[2],
                'fee' => $row[3],
                'duration_hours' => $row[4],
                'created_at' => now(),
            ]);
        }


        /*
         *  MANUAL INSERT EACH RECORD INTO PACKAGES TABLE

        DB::table('packages')->insert([
            'type' => 'bike',
            'name' => 'Bike Adult',
            'price' => 10,
            'fee' => 2.8,
            'duration_hours' => 2,
            'created_at' => now(),
        ]);

        DB::table('packages')->insert([
            'type' => 'bike',
            'name' => 'Bike Adult',
            'price' => 10,
            'fee' => 2.8,
            'duration_hours' => 2,
            'created_at' => now(),
        ]);

        */


    }


}
