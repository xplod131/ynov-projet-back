<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserApiController extends AbstractController
{
    #[Route('/api/user', name: 'user_api')]
    public function index()
    {
        // Get the current user
        $user = $this->getUser();

        // Return the user's id, email, and roles in JSON format
        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }

    #[Route('/api/user/checkrole', name: 'user_api_check_role', methods: 'POST')]
    public function checkRole(Request $request)
    {
        // Get the role sent in the POST request
        $role = $request->request->get('role');

        // Check if the user has the role
        $hasRole = $this->getUser()->hasRole($role);

        // If the user has the role, return true in JSON format
        if ($hasRole) {
            return new JsonResponse(true);
        }

        // Otherwise, return a 400 HTTP error
        return new JsonResponse('Invalid role', 400);
    }
}
