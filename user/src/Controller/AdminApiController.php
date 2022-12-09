<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminApiController extends AbstractController
{
    #[Route('/api/admin', name: 'admin_api')]
    public function index(Request $request)
    {
        // Get the role sent in the POST request
        $role = $request->request->get('role');

        // If the role is "admin", return true in JSON format
        if ($role === 'ROLE_ADMIN') {
            return new JsonResponse(true);
        }

        // Otherwise, return a 400 HTTP error
        return new JsonResponse('Invalid role', 400);
    }
}
