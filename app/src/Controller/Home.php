<?php
    namespace App\Controller ;

    use DateTime;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use App\Entity\User;
    use Doctrine\ORM\EntityManagerInterface;

    class Home extends AbstractController
    {
        #[Route('/', name: 'home', methods: ['GET'])]
        public function Home(SessionInterface $session, EntityManagerInterface $entityManager)
        {
            //if(isset($_GET["email"])){
                // $UserEntity = $entityManager->getRepository(User::class)
                //     ->findOneBy(['email' => $_GET["email"]]);
                // $session->set('user', ['User' => $UserEntity]);
            //}

            if(isset($_GET["year"])){
                $year = $_GET["year"];
                $month = $_GET["month"];
            } else {
                $year = date('Y');
                $month = date('m');
            }

            if($month == 13){
                $month = 1;
                $year += 1;
            }

            if($month == 0){
                $month = 12;
                $year -= 1;
            }

            $firstDay = new DateTime("$year-$month-01");
            $lastDay = new DateTime("$year-$month-" . $firstDay->format('t'));
            $currentDay = clone $firstDay;
            $weeks = [];

            while ($currentDay <= $lastDay) {
                $weeks[$currentDay->format('W')][] = clone $currentDay;
                $currentDay->modify('+1 day');
            }

            return $this->render("home.html.twig",[
                'weeks' => $weeks,
                'year' => $year,
                'month' => $month,
                // 'email' => $email,
            ]);
        }

    }
?>