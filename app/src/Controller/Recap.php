<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use App\Entity\Score;
    use Doctrine\ORM\EntityManagerInterface;

    class Recap extends AbstractController
    {
        #[Route('/recap', name: 'recap', methods: ['GET'])]
        public function Recap( SessionInterface $session)
        {
            $storedData = $session->get('recap');
                // Accéder aux données individuelles
                $word = $storedData['word'];
                $round = $storedData['round'];

            return $this->render("recap.html.twig",[
                'word' => $word,
                'round' => $round,
            ]);
        }

    }
?>