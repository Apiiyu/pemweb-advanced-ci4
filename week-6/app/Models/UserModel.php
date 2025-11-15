<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'email',
        'password',
        'full_name',
        'reset_token',
        'reset_token_expires',
        'is_active'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'username' => [
            'required'    => 'Username harus diisi',
            'min_length'  => 'Username minimal 3 karakter',
            'max_length'  => 'Username maksimal 100 karakter',
            'is_unique'   => 'Username sudah digunakan',
        ],
        'email' => [
            'required'    => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique'   => 'Email sudah terdaftar',
        ],
        'password' => [
            'required'   => 'Password harus diisi',
            'min_length' => 'Password minimal 8 karakter',
        ],
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before saving to database
     */
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    /**
     * Verify user credentials
     */
    public function verifyCredentials(string $identifier, string $password): ?array
    {
        // Check if identifier is email or username
        $user = $this->where('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();

        if (!$user) {
            return null;
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return null;
        }

        // Check if user is active
        if (!$user['is_active']) {
            return null;
        }

        // Remove password from returned data
        unset($user['password']);
        return $user;
    }

    /**
     * Check if email exists
     */
    public function emailExists(string $email): bool
    {
        return $this->where('email', $email)->countAllResults() > 0;
    }

    /**
     * Check if username exists
     */
    public function usernameExists(string $username): bool
    {
        return $this->where('username', $username)->countAllResults() > 0;
    }

    /**
     * Generate and save password reset token
     */
    public function generateResetToken(string $email): ?string
    {
        $user = $this->where('email', $email)->first();
        
        if (!$user) {
            return null;
        }

        // Generate random token
        $token = bin2hex(random_bytes(32));
        
        // Set token expiry (1 hour from now)
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Update user record
        $this->update($user['id'], [
            'reset_token'         => $token,
            'reset_token_expires' => $expires
        ]);

        return $token;
    }

    /**
     * Verify reset token
     */
    public function verifyResetToken(string $token): ?array
    {
        $user = $this->where('reset_token', $token)
            ->where('reset_token_expires >', date('Y-m-d H:i:s'))
            ->first();

        return $user;
    }

    /**
     * Reset password using token
     */
    public function resetPassword(string $token, string $newPassword): bool
    {
        $user = $this->verifyResetToken($token);
        
        if (!$user) {
            return false;
        }

        // Update password and clear reset token
        return $this->update($user['id'], [
            'password'            => $newPassword,
            'reset_token'         => null,
            'reset_token_expires' => null
        ]);
    }

    /**
     * Get user by ID (without password)
     */
    public function getUserById(int $id): ?array
    {
        $user = $this->find($id);
        
        if ($user) {
            unset($user['password']);
        }
        
        return $user;
    }
}