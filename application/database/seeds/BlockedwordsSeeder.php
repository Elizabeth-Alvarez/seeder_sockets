<?php

class BlockedwordsSeeder extends Seeder {

    private $table = 'blockedwords';

    public function run() {
        $this->db->truncate($this->table);

        $limit = 300;
        echo "seeding $limit user accounts";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'word' => $this->faker->unique()->word,
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
