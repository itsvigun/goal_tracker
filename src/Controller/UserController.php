<?php

namespace App\Controller;

use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\UserService;

class UserController extends AbstractFOSRestController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Rest\Get("/first")
     * @param Request $request
     * @return View
     */
    public function test(Request $request): View
    {

        $name = $this->userService->getNullName();
        if (!$name) {
            throw new EntityNotFoundException('User does not exist!');
        }
        $data = [
            'name' => $this->userService->getName(),
            'surname' => 'Tsvihun',
        ];

        return View::create($data, Response::HTTP_CREATED);
    }
}