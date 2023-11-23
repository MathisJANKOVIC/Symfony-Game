<?php
    namespace App\Controller ;

    use DateTime;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class Home extends AbstractController
    {
        #[Route('/', name: 'home', methods: ['GET'])]
        public function Home()
        {
            $year = $_GET["year"];
            $month = $_GET["month"];
            if ($year == null) {
                $year = date('Y');
                $month = date('m');
            }

            $months = [];
            $firstDay = new DateTime("$year-$month-01");
            $lastDay = new DateTime("$year-$month-" . $firstDay->format('t'));
            $currentDay = clone $firstDay;
            $weeks = [];

            while ($currentDay <= $lastDay) {
                $weeks[$currentDay->format('W')][] = clone $currentDay;
                $currentDay->modify('+1 day');
            }

            return $this->render("home.html.twig", [
                            'weeks' => $weeks,
                            'year' => $year,
                            'months' => $months,
                            'month' => $month,
            ]);
        }

    }