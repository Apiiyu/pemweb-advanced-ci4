<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Check if user is authenticated before allowing access
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            // Redirect to login page with return URL
            $returnUrl = current_url();
            return redirect()->to('/auth/login?return=' . urlencode($returnUrl))
                ->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    /**
     * Allows after actions
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
