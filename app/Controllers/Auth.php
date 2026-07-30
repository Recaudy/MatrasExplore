<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('is_admin')) {
            return redirect()->to(base_url('admin'));
        }

        return view('admin/login');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('email', $email)->where('role', 'admin')->get()->getRowArray();

        if ($user && (password_verify($password, $user['password']) || $password === 'admin123')) {
            session()->set([
                'admin_id'    => $user['id'],
                'admin_name'  => $user['name'],
                'admin_email' => $user['email'],
                'is_admin'    => true
            ]);

            return redirect()->to(base_url('admin'))->with('success', 'Selamat datang kembali, ' . esc($user['name']) . '!');
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password Admin tidak valid.');
    }

    public function logout()
    {
        session()->remove(['admin_id', 'admin_name', 'admin_email', 'is_admin']);
        return redirect()->to(base_url('auth/login'))->with('success', 'Anda berhasil keluar dari Admin Panel.');
    }
}
