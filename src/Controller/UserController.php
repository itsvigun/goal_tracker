<?php

namespace App\Controller;

use App\Entity\Users;
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
     * @Rest\Get("/users")
     * @param Request $request
     * @return View
     */
    public function getUserData(Request $request): View
    {
        $data = ['test'];

        return View::create($data, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post("/users")
     * @param Request $request
     * @return View
     */
    public function addUser(Request $request): View
    {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $email = $request->request->get('email');


        $a = 1;
        exit;
        $entityManager = $this->getDoctrine()->getManager();
        $user = new Users();
        $user->setName('Ihor')
            ->setSurname('Tsvihun')
            ->setEmail('sairustsv@gmail.com');

        $entityManager->persist($user);
        $entityManager->flush();

        $data = [$user];

        return View::create($data, Response::HTTP_CREATED);
    }
}