<?php
    namespace App\Controller;

    use App\Entity\Word; // Assurez-vous d'importer l'entité Word
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class Game extends AbstractController
    {
        #[Route('/game', name: 'game', methods: ['GET', 'POST'])]
        public function game( EntityManagerInterface $entityManager , Request $request , SessionInterface $session): Response
        {
            if(isset($_GET['selected_day'])){
                $wordEntity = $entityManager->getRepository(Word::class)
                    ->findOneBy(['date' => new \DateTime($_GET['selected_day'])]);
                $word = $wordEntity->getWord();
                $columns = strlen($word);
                $rows = [];
                for ($i = 0; $i < 8; $i++) {
                    $row = [];
                    for ($j = 0; $j < $columns; $j++) {
                        $row[] = '.'; // Initialisation avec des valeurs null, vous pouvez changer cela selon vos besoins
                    }
                    $rows[] = $row;
                }
                $rows[0][0] = substr($word, 0, 1);
                $colors = [];
                for ($i = 0; $i < 8; $i++) {
                    $color = [];
                    for ($j = 0; $j < $columns; $j++) {
                        $color[] = 'grey'; // Initialisation avec des valeurs null, vous pouvez changer cela selon vos besoins
                    }
                    $colors[] = $color;
                }
                $round = 0;
            }

            if(null != $session->get('game')){
                $storedData = $session->get('game');
                // Accéder aux données individuelles
                $word = $storedData['word'];
                $columns = $storedData['columns'];
                $rows = $storedData['rows'];
                $colors = $storedData['colors'];
                $round = $storedData['round'];
            }

            // Création du formulaire
            $form = $this->createFormBuilder()
                ->add('word', TextType::class, [
                    'label' => 'Mot :',
                    'constraints' => [
                        new Length([
                            'min' => $columns,
                            'max' => $columns,
                            'exactMessage' => 'Le mot doit avoir exactement {{ limit }} caractères.'
                        ]),
                    ]
                ])
                ->add('submit', SubmitType::class, ['label' => 'Valider'])
                ->getForm();
            
            // Gestion de la soumission du formulaire
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Récupération des données du formulaire
                $data = $form->getData();
                $value = $data['word'];

                for ($i = 0; $i < $columns; $i++) {   
                    $rows[$round][$i]=$value[$i];
                }

                for ($i = 0; $i < $columns; $i++) {
                    for ($j = 0; $j < $columns; $j++) {
                        if (strtolower($value[$i]) === strtolower($word[$j])){
                            $colors[$round][$i]='orange';
                        }
                    }
                }

                for ($i = 0; $i < $columns; $i++) {   
                    if (strtolower($value[$i]) === strtolower($word[$i])){
                        $colors[$round][$i]='red';
                    }
                }

                $finished = (strtolower($value) === strtolower($word));

                $round += 1;
            }else{
                $finished = FALSE;
            }

            $session->set('game', [
                'word' => $word,
                'columns' => $columns,
                'rows' => $rows,
                'colors' => $colors,
                'round' => $round,
            ]);

            if(! isset($_GET['selected_day'])){
                if($round != $storedData['round']){
                    return $this->redirectToRoute('game');
                }
            }

            if($finished){ 
                $session->set('game', []);
            }

            return $this->render("game.html.twig", [
                'form' => $form->createView(),
                'word' => $word,
                'rows' => $rows,
                'colors' => $colors,
                'finished' => $finished,
            ]);
        }
    }


    