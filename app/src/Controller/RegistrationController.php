<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('avatar')->getData();

            if($avatarFile)
            {
                // is needed to safely include the file name as part of the URL
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                // Move the file to the directory where brochures are stored
                $avatarFile->move($this->getParameter('kernel.project_dir') . '/public/avatars', $newFilename);

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setAvatarFileName($newFilename);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
