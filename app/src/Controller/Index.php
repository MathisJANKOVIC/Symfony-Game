<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class Index extends AbstractController
    {
        #[Route('/', name: 'index', methods: ['GET'])]
        public function index()
        {
            return $this->render("index.html.twig", [
                "title" => "Hello World !",
            ]);
        }
    }