<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvoiceRepository;
use App\Entity\Invoice;
use App\Form\InvoiceEditType;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'app_invoice')]
    public function index(
        InvoiceRepository $invoiceRepository
    ): Response
    {
        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoiceRepository->findAll(),
        ]);
    }

    #[Route('/invoice/{id}', name: 'app_invoice_show')]
    public function show(
        Invoice $invoice
    ): Response
    {
        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }

    #[Route('/invoice/{id}/edit', name: 'app_invoice_edit')]
    public function edit(
        Invoice $invoice,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(InvoiceEditType::class, $invoice);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $form->getData();

            $entityManager->persist($invoice);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Facture est bien mise à jour !'
            );

            return $this->redirectToRoute('app_invoice');
        }

        return $this->render('invoice/edit.html.twig', [
            'invoice'   => $invoice,
            'form'      => $form
        ]);
    }

    #[Route('/invoice/{id}/delete', name: 'app_invoice_delete')]
    public function delete(
        Invoice $invoice,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $entityManager->remove($invoice);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Facture est supprimé !'
        );

        return $this->redirectToRoute('app_invoice');
    }
}
