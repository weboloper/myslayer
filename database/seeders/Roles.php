<?php

use Clarity\Support\Phinx\Seed\AbstractSeed;

class Roles extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $data = [
            [
                'name'        => 'admin',
                'description' =>  'admin user'
            ],
            [
                'name'        => 'moderator',
                'description' =>  'moderator user'
            ] 
        ];

        $user = $this->table('roles');
        $user->insert($data)
              ->save();

    }
}
