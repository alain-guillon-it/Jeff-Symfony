<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;

#[Route("/user", name: "app_user_")]
class UserController extends AbstractController {

    #[Route(path: "/", name: "index", methods: "GET")]
    public function index(Request $request, UserRepository $userRepository): Response 
    {

        //dd($request);
        return $this->render("user/index.html.twig", [
            "users" => $userRepository->findAll()
        ]);
    }

    #[Route(path: "/new", name: "new", methods: ["GET", "POST"])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        dump($form->getData());

        if ($form->isSubmitted()) {
            $userRepository->save($user, true);
            return $this->redirectToRoute("app_user_index");
        }

        return $this->render('user/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[
        Route(
            path: "/edit/{id}", 
            name: "edit", 
            methods: ["GET", "POST"],
            requirements: ['id' => '\d+']
        )
    
    ]
    public function edit(Request $request, UserRepository $userRepository, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            return $this->redirectToRoute("app_user_index");
        }

        return $this->render('user/edit.html.twig', [
            "form" => $form->createView(),
            "user" => $user
        ]);
    }

    #[Route(path: "/show/{id}", name: "show", methods: ["GET"])]
    public function show(Request $request, User $user, $id): Response
    {
        // dd($request); // attributes id
        // dd($id);
        return $this->render("user/show.html.twig", [
            "user" => $user
        ]);
    }

}