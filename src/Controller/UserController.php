<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\UserService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        phpinfo(); exit;
        $data = ['test'];

        return View::create($data, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post("/users/registration")
     * @param Request $request
     * @return View
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder, SerializerInterface $serializer): View
    {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = new Users();
        $password = $passwordEncoder->encodePassword($user, $password);

        $user->setName($name)
            ->setSurname($surname)
            ->setEmail($email)
            ->setPassword($password);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $data = [$user];

        return View::create($data, Response::HTTP_CREATED);
    }
}