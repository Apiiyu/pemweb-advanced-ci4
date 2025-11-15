<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url']);
    }

    /**
     * Display login page
     */
    public function login()
    {
        // Redirect if already logged in
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/news');
        }

        $data = [
            'title' => 'Login',
            'validation' => $this->validation
        ];

        return view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function attemptLogin()
    {
        // Validation rules
        $rules = [
            'identifier' => [
                'label' => 'Email/Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $identifier = $this->request->getPost('identifier');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        // Verify credentials
        $user = $this->userModel->verifyCredentials($identifier, $password);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email/Username atau Password salah');
        }

        // Set session
        $sessionData = [
            'user_id'     => $user['id'],
            'username'    => $user['username'],
            'email'       => $user['email'],
            'full_name'   => $user['full_name'],
            'isLoggedIn'  => true
        ];

        $this->session->set($sessionData);

        // Set remember me cookie if checked
        if ($remember) {
            $this->setRememberMeCookie($user['id']);
        }

        return redirect()->to('/admin/news')
            ->with('success', 'Selamat datang, ' . $user['full_name'] . '!');
    }

    /**
     * Display registration page
     */
    public function register()
    {
        // Redirect if already logged in
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/news');
        }

        $data = [
            'title' => 'Register',
            'validation' => $this->validation
        ];

        return view('auth/register', $data);
    }

    /**
     * Process registration
     */
    public function attemptRegister()
    {
        // Validation rules
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[100]|is_unique[users.username]|alpha_numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 100 karakter',
                    'is_unique' => '{field} sudah digunakan',
                    'alpha_numeric' => '{field} hanya boleh berisi huruf dan angka'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => '{field} tidak valid',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'full_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 255 karakter'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 8 karakter'
                ]
            ],
            'password_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'matches' => '{field} tidak sama dengan Password'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save user
        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'password'  => $this->request->getPost('password'),
            'is_active' => 1
        ];

        if ($this->userModel->save($data)) {
            return redirect()->to('/auth/login')
                ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    /**
     * Display forgot password page
     */
    public function forgotPassword()
    {
        // Redirect if already logged in
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/news');
        }

        $data = [
            'title' => 'Lupa Password',
            'validation' => $this->validation
        ];

        return view('auth/forgot_password', $data);
    }

    /**
     * Process forgot password request
     */
    public function processForgotPassword()
    {
        // Validation rules
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => '{field} tidak valid'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');

        // Check if email exists
        if (!$this->userModel->emailExists($email)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar');
        }

        // Generate reset token
        $token = $this->userModel->generateResetToken($email);

        if ($token) {
            // In production, send email with reset link
            // For now, we'll just show the token (for demonstration)
            $resetLink = base_url('auth/reset-password/' . $token);
            
            // TODO: Send email
            // $this->sendResetEmail($email, $resetLink);

            return redirect()->to('/auth/login')
                ->with('success', 'Link reset password telah dikirim ke email Anda. (Demo: ' . $resetLink . ')');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Display reset password page
     */
    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('/auth/forgot-password')
                ->with('error', 'Token tidak valid');
        }

        // Verify token
        $user = $this->userModel->verifyResetToken($token);

        if (!$user) {
            return redirect()->to('/auth/forgot-password')
                ->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        $data = [
            'title' => 'Reset Password',
            'token' => $token,
            'validation' => $this->validation
        ];

        return view('auth/reset_password', $data);
    }

    /**
     * Process password reset
     */
    public function processResetPassword()
    {
        // Validation rules
        $rules = [
            'token' => [
                'label' => 'Token',
                'rules' => 'required'
            ],
            'password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 8 karakter'
                ]
            ],
            'password_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'matches' => '{field} tidak sama dengan Password Baru'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $token = $this->request->getPost('token');
            return redirect()->to('/auth/reset-password/' . $token)
                ->with('errors', $this->validator->getErrors());
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // Reset password
        if ($this->userModel->resetPassword($token, $password)) {
            return redirect()->to('/auth/login')
                ->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
        } else {
            return redirect()->to('/auth/reset-password/' . $token)
                ->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Remove remember me cookie
        $this->removeRememberMeCookie();

        // Destroy session
        $this->session->destroy();

        return redirect()->to('/auth/login')
            ->with('success', 'Anda berhasil logout');
    }

    /**
     * Set remember me cookie
     */
    private function setRememberMeCookie($userId)
    {
        $token = bin2hex(random_bytes(32));
        
        // Set cookie for 30 days
        setcookie('remember_token', $token, time() + (86400 * 30), '/');
        
        // In production, save token to database for verification
        // For now, we'll just set the cookie
    }

    /**
     * Remove remember me cookie
     */
    private function removeRememberMeCookie()
    {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
    }
}
