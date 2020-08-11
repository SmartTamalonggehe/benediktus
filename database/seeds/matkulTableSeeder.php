<?php

use App\Models\Matkul;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class matkulTableSeeder extends Seeder
{
    protected $matkul;
    protected $faker;

    public function __construct(Matkul $matkul, Faker $faker)
    {
        $this->matkul=$matkul;
        $this->faker=$faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,50) as $fk) {
            $this->matkul->create([
                'kd_matkul' => Str::random(10),
                'nm_matkul'=>$this->faker->sentence(2),
                'sks'=>rand(1,6),
                'semester'=>rand(1,8),
            ]);
        }
    }
}
