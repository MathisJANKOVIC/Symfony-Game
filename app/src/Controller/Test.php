<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;

    class Test extends AbstractController
    {
        #[Route('/test', name: 'test', methods: ['GET'])]
        public function test(): Response
        {
            return $this->render("test.html.twig", [
                "title" => "Hello World !",
            ]);
        }
    }
