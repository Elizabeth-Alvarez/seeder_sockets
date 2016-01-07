<?php

class UsersSeeder extends Seeder {

    private $table = 'users';

    public function run() {
        $this->db->truncate($this->table);

        $limit = 1000;
        echo "seeding $limit user accounts";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'full_name' => $this->faker->firstName,
                'email' => $this->faker->email,
                'city' => $this->faker->city,
                'created_at' => $this->faker->date($format = 'Y-m-d'),
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
