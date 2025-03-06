<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function showLoginPage()
    {
        return view('pages/auth/login');
    }

    public function showRegisterPage()
    {
        return view('pages/auth/register');
    }

    public function loginAccount()
    {
        $session = session();
        $request = service('request');
        $userModel = new UserModel();
        $identity = esc(strip_tags($request->getPost('identity')));
        $password = esc(strip_tags($request->getPost('password')));

        // Cek user berdasarkan email atau username
        $user = $userModel->where('email', $identity)
            ->orWhere('username', $identity)
            ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            $session->setFlashdata('error', 'Invalid email/username or password.');
            return redirect()->to('/');
        }

        if ($user['approval_status'] === 'pending') {
            $session->setFlashdata('error', 'Your account is awaiting approval. Please contact the administrator for activation.');
            return redirect()->to('/');
        }

        // Set session jika login berhasil
        $session->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function registerAccount()
    {
        $session = session();
        $request = service('request');
        $userModel = new UserModel();

        // Sanitasi input
        $name     = esc(strip_tags($request->getPost('name')));
        $username = esc(strip_tags($request->getPost('username')));
        $email    = esc(strip_tags($request->getPost('email')));
        $password = $request->getPost('password');

        // Validasi input
        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            $session->setFlashdata('error', 'All fields are required.');
            return redirect()->back();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session->setFlashdata('error', 'Invalid email format.');
            return redirect()->back();
        }

        // Cek apakah username atau email sudah digunakan
        if ($userModel->where('email', $email)->orWhere('username', $username)->first()) {
            $session->setFlashdata('error', 'Username or email already exists.');
            return redirect()->back();
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $userModel->insert([
            'name'     => $name,
            'username' => $username,
            'email'    => $email,
            'password' => $hashedPassword,
            'role'     => 'User',
            'approval_status' => 'pending'
        ]);

        $session->setFlashdata('success', 'Registration successful. Please wait until admin approve!');
        return redirect()->to('/register');
    }
}
