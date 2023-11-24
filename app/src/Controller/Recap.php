<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Score;
    use App\Entity\User;

    class Recap extends AbstractController
    {
        #[Route('/recap', name: 'recap', methods: ['GET','POST'])]
        public function Recap( SessionInterface $session, Request $request , EntityManagerInterface $entityManager)
        {
            $storedData = $session->get('recap');
                // Accéder aux données individuelles
                $word = $storedData['word'];
                $round = $storedData['round'];
            $storedData = $session->get('user');
                // Accéder aux données individuelles
            // $entityManager = $entityManager->getRepository(User::class);
            //     $User = $entityManager->getUserIdentifier();
            
            if ($request->isMethod('POST')) {
                $likeAction = $request->request->get('like_action');
        
                if ($likeAction === 'like') {
                    $likes = true;

                    return new Response('Liked!');
                }
            }


            $entityManager = $entityManager->getRepository(Score::class);

                // Création d'une nouvelle instance de Score
            // $score = new Score();
            // $score->setIdUser($User); // Remplacez $idUser par l'ID de l'utilisateur concerné
            // $score->setIdWord($word); // Remplacez $idWord par l'ID du mot concerné
            // $score->setLiked($likes); // Mettez la valeur souhaitée pour liked
            // $score->setAttemptCount($round + 1); // Mettez la valeur souhaitée pour attempt_count, par exemple 1 pour une nouvelle tentative
                
            // // Persister et flusher l'entité dans la base de données
            // $entityManager->persist($score);
            // $entityManager->flush();

            return $this->render("recap.html.twig",[
                'word' => $word,
                'round' => $round,
            ]);
        }

    }
?>