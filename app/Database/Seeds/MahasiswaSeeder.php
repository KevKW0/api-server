<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $mahasiswa = [
            [
                'name'          => 'Muhamad Rizky Ramadani',
                'npm'           => '202210003',
                'phone'         => '089614267384',
                'email'         => '202210003@ibik.ac.id',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Rizki Pajar',
                'npm'           => '202210032',
                'phone'         => '0897560847',
                'email'         => '202210032@ibik.ac.id',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Arda Ardiansyah',
                'npm'           => '202210025',
                'phone'         => '087781989373',
                'email'         => '202210025@ibik.ac.id',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
        ];

        foreach ($mahasiswa as $data) {
            $this->db->table('mahasiswa')->insert($data);
        }
    }
}
