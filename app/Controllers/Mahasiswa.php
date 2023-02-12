<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MahasiswaModel;


class Mahasiswa extends BaseController
{
    use ResponseTrait;

    // Get All Mahasiswa
    public function index()
    {
        $model = new MahasiswaModel();

        return $this->respond([
            'statusCode' => 200,
            'message' => 'OK',
            'data' => $model->orderBy('id', 'ASC')->findAll()
        ]);
    }

    // Get Mahasiswa By ID
    public function show($id)
    {
        $model = new MahasiswaModel();
        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond([
                'statusCode' => 200,
                'message' => 'OK',
                'data' => $data
            ]);
        } else {
            return $this->respond([
                'statusCode' => 404,
                'message' => 'Not Found',
            ]);
        }
    }

    // Create Mahasiswa
    public function create()
    {
        if ($this->request) {
            $model = new MahasiswaModel();

            // Get Data Dari Front End
            if ($this->request->getJSON()) {
                $json = $this->request->getJSON();
                $data = [
                    'name'          => $json->name,
                    'npm'           => $json->npm,
                    'phone'         => $json->phone,
                    'email'         => $json->email,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ];

                $model->insert($data);
            } else {
                $name   = $this->request->getPost('name');
                $npm    = $this->request->getPost('npm');
                $phone  = $this->request->getPost('phone');
                $email  = $this->request->getPost('email');

                // Request Dari Postman, dll
                $data = [
                    'name'          => $name,
                    'npm'           => $npm,
                    'phone'         => $phone,
                    'email'         => $email,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ];

                if (empty($name) || empty($npm) || empty($phone) || empty($email)) {
                    return $this->respond([
                        'statusCode' => 400,
                        'message' => 'Bad Request: All Field are Required'
                    ], 400);
                }

                $model->insert($data);
            }

            return $this->respond([
                'statusCode' => 201,
                'message' => 'Data Created Successfully',
            ], 201);
        }
    }

    // Update Mahasiswa
    public function update($id = null)
    {
        $model = new MahasiswaModel();

        // Cek apakah ID ditemukan
        $mahasiswa = $model->find($id);
        $createdAt = $mahasiswa['created_at'];

        if (!$mahasiswa) {
            $response = [
                'statusCode' => 404,
                'message' => 'Mahasiswa with ID ' . $id . ' Not Found',
            ];
            return $this->respond($response);
        }


        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'name'          => $json->name ?? null,
                'npm'           => $json->npm ?? null,
                'phone'         => $json->phone ?? null,
                'email'         => $json->email ?? null,
                'created_at'    => $createdAt,
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'name'          => $input['name'] ?? null,
                'npm'           => $input['npm'] ?? null,
                'phone'         => $input['phone'] ?? null,
                'email'         => $input['email'] ?? null,
                'created_at'    => $createdAt,
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        }

        // Cek apakah Data Kosong
        foreach ($data as $key => $value) {
            if ($value == null) {
                return $this->respond([
                    'statusCode' => 400,
                    'message' => $key . ' is required'
                ], 400);
            }
        }

        // Insert Data Ke Database
        $model->update($id, $data);
        $reponse = [
            'statusCode' => 200,
            'message' => 'Data Updated Successfully',
        ];
        return $this->respond($reponse);
    }

    // Delete Data
    public function delete($id)
    {
        $model = new MahasiswaModel();
        $mahasiswa = $model->find($id);

        if (!$mahasiswa) {
            $repsonse = [
                'statusCode' => 400,
                'message' => 'Mahasiswa with ID ' . $id . ' Not Found'
            ];
            return $this->respond($repsonse);
        } else {
            $model->delete($id);
            $repsonse = [
                'statusCode' => 200,
                'message' => 'Data Deleted Succesfully'
            ];

            return $this->respond($repsonse);
        }
    }
}
