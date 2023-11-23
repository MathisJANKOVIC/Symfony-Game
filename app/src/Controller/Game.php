<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class Game extends AbstractController
    {
        #[Route('/Game', name: 'Game', methods: ['GET','HEAD'], )]
        public function Game(): Response
        {
            $selected_day=$_GET['selected_day'];
            return $this->render("Game.html.twig", [
                'selected_day' => $selected_day,
            ]);
        }

    }