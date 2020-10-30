<?php

namespace App\Controller\Chikowa;

use App\Entity\ChikowaUser;
use App\Repository\Chikowa\AssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/chikowa/", name="chikowa_dashboard_index")
     * @Route("/chikowa/dashboard", name="chikowa_dashboard")
     * @return Response
     */
    public function index()
    {
        /** @var ChikowaUser $currentUser */
        $currentUser=$this->getUser();
        $nombreTontine =0;
        $nombreMembre=0;

        foreach ($currentUser->getAssociations() as $association){
            $nombreTontine+=$association->getTontines()->count();
            foreach ($association->getTontines() as $tontine) {
                $nombreMembre += $tontine->getInscriptions()->count();
            }
        }

        return $this->render('chikowa/dashboard/index.html.twig', [
            'associations' => $currentUser->getAssociations(),
            'nombreTontine'=>$nombreTontine,
            'nombreMembre'=>$nombreMembre
        ]);
    }
}
