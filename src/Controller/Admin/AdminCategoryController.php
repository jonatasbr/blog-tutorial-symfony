<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories")
 */
class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/", name="admin_category")
     */
    public function index()
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render("admin/categories/index.html.twig", [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/new", name="admin_category_new")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $category->setCreatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));
            $category->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash("success", "Categoria salva com sucesso!");
            return $this->redirectToRoute("admin_category");
        }

        return $this->render("admin/categories/new.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="admin_category_update")
     */
    public function update(Request $request, Category $id)
    {
        $form = $this->createForm(CategoryType::class, $id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $category->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

            $em = $this->getDoctrine()->getManager();
            $em->merge($category);
            $em->flush();

            $this->addFlash("success", "Categoria atualizada com sucesso!");
            return $this->redirectToRoute("admin_category");
        }

        return $this->render("admin/categories/update.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_category_delete")
     */
    public function delete(Category $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();

        $this->addFlash("success", "Categoria removida com sucesso!");
        return $this->redirectToRoute("admin_category");
    }
}