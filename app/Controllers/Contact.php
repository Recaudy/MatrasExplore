<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    public function index()
    {
        $settingModel = new \App\Models\SettingModel();
        
        $data = [
            'title' => 'Kontak Kami',
            'settings' => $settingModel->getAllSettingsAsMap(),
            'pageStyles' => ['home.css']
        ];
        return view('contact/index', $data);
    }

    public function send()
    {
        // Check if AJAX request
        $isAjax = $this->request->isAJAX();

        $rules = [
            'name' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.'
                ]
            ],
            'phone' => [
                'rules'  => 'required|min_length[10]|max_length[16]',
                'errors' => [
                    'required'   => 'Nomor WhatsApp wajib diisi.',
                    'min_length' => 'Nomor WhatsApp minimal 10 karakter.',
                    'max_length' => 'Nomor WhatsApp maksimal 16 karakter.'
                ]
            ],
            'subject' => [
                'rules'  => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'required'   => 'Subjek wajib diisi.',
                    'min_length' => 'Subjek minimal 5 karakter.',
                    'max_length' => 'Subjek maksimal 200 karakter.'
                ]
            ],
            'message' => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Isi pesan wajib diisi.',
                    'min_length' => 'Isi pesan minimal 10 karakter.'
                ]
            ]
        ];

        // Run Validation
        if (!$this->validate($rules)) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $contactModel = new ContactModel();

        // Insert message details into contact_messages table
        $contactModel->insert([
            'name'       => $this->request->getPost('name'),
            'phone'      => $this->request->getPost('phone'),
            'subject'    => $this->request->getPost('subject'),
            'message'    => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim! Kami akan segera merespons melalui WhatsApp.'
            ]);
        }

        return redirect()->to(base_url('#contact'))->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera merespons melalui WhatsApp.');
    }
}
