<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProductNewType;

#[Route('/products')]
class ProductController extends AbstractController
{
    #[Route('/new', name: 'product_new')]
    public function new(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductNewType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Produit bien ajouté !'
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'product_edit')]
    public function edit(
        Product $product,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(ProductNewType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Produit bien mise à jour !'
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('product/edit.html.twig', [
            'product'   => $product,
            'form'      => $form
        ]);
    }
}
