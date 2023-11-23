<?php
    namespace App\Controller;

    use DateTime;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class Home extends AbstractController
    {
        #[Route('/', name: 'Home', methods: ['GET','HEAD'])]
        public function Home()
        {
            $year = date('Y');
            $months = [];
    
            for ($month = 1; $month <= 12; $month++) {
                $firstDay = new DateTime("$year-$month-01");
                $lastDay = new DateTime("$year-$month-" . $firstDay->format('t'));
    
                $currentDay = clone $firstDay;
                $weeks = [];
    
                while ($currentDay <= $lastDay) {
                    $weeks[$currentDay->format('W')][] = clone $currentDay;
                    $currentDay->modify('+1 day');
                }
    
                $months[$month] = $weeks;
            }

            return $this->render("Home.html.twig", [
                            'weeks' => $weeks,
                            'year' => $year,
                            'months' => $months,
                            'month' => 11,
                        ]);
        }

    }