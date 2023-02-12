<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();
        $pwd_verify = password_verify($password, $user['password']);

        // Cek Apakah Username Kosong
        if (is_null($user) && !$pwd_verify) {
            return $this->respond(['error' => 'Invalid Username or Password']);
        }

        $key = getenv('JWT_SECRET_KEY');
        $iat = time(); // Waktu Sekarang
        $exp = $iat + 3600;

        $payload = [
            'iss' => 'Penerbit JWT',
            'aud' => 'Audience JWT',
            'sub' => 'Subject JWT',
            'iat' => $iat, // Waktu JWT Diterbitkan
            'exp' => $exp, // Waktu Expired JWT
            'username' => $user['username']
        ];

        $token = JWT::encode($payload, $key, 'HS256');
        $response = [
            'message' => 'Login Successfully',
            'token' => $token
        ];

        return $this->respond($response, 200);
    }
}
