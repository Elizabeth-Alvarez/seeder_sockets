<?php

class WordsSeeder extends Seeder {

    private $table = 'words';

    public function run() {
        $this->db->truncate($this->table);

        $limit = 300;
        echo "seeding $limit user accounts";

        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'word' => $this->faker->word,
                'created_at' => $this->faker->date($format = 'Y-m-d'),
            );

            $this->db->insert($this->table, $data);
        }

        echo PHP_EOL;
    }
}
