<?php

use Illuminate\Database\Seeder;
use App\JudicialType;

class JudicialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new JudicialType();
        $role->name = 'Civil';
        $role->description = 'Materia Civil';
        $role->save();

        $role = new JudicialType();
        $role->name = 'Familiar';
        $role->description = 'Materia Familiar';
        $role->save();

    }
}
