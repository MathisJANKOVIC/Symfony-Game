<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class Game extends AbstractController
    {
        #[Route('/game', name: 'game', methods: ['GET'])]
        public function game(): Response
        {
            $selected_day = $_GET['selected_day'];

            return $this->render("game.html.twig", [
                'selected_day' => $selected_day,
            ]);
        }

    }