<?php

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class prodiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'kd_prodi'=>'SI',
            'nm_prodi'=>'Sistem Informasi',
            ]);
        Prodi::create([
            'kd_prodi'=>'TG',
            'nm_prodi'=>'Teknik Geologi',
            ]);
        Prodi::create([
            'kd_prodi'=>'BI',
            'nm_prodi'=>'Biologi',
            ]);
    }
}
