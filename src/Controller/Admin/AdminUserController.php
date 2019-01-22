<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/users")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user")
     */
    public function index()
    {
        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        return $this->render("admin/users/index.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
            $user->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Usuário salvo com sucesso!");
            return $this->redirectToRoute("admin_user");
        }

        return $this->render("admin/users/new.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="admin_user_update")
     */
    public function update(Request $request, UserPasswordEncoderInterface $passwordEncoder, User $id)
    {
        $form = $this->createForm(UserType::class, $id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $em = $this->getDoctrine()->getManager();
            $em->merge($user);
            $em->flush();

            $this->addFlash("success", "Usuário atualizado com sucesso!");
            return $this->redirectToRoute("admin_user");
        }

        return $this->render("admin/users/update.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_user_delete")
     */
    public function delete(User $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();

        $this->addFlash("success", "Usuário removido com sucesso!");
        return $this->redirectToRoute("admin_user");
    }
}