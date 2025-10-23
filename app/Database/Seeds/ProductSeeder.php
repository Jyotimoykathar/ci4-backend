<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Apple', 'price' => 50.00],
            ['name' => 'Banana', 'price' => 20.00],
        ];
        $this->db->table('products')->insertBatch($data);
    }
}
