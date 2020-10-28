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
     * @Route("/chikowa/dashboard", name="chikowa_dashboard")
     * @param AssociationRepository $associationRepository
     * @return Response
     */
    public function index()
    {
        /** @var ChikowaUser $currentUser */
        $currentUser=$this->getUser();
        if($currentUser->getAssociations()->isEmpty()){
           // return $this->redirectToRoute('chikowa_association_new');
        }
        $nombreTontine =0;
        $nombreMembre=0;

        foreach ($currentUser->getAssociations() as $association){
            $nombreTontine+=$association->getTontines()->count();
            $nombreMembre+=$association->getMembres()->count();
        }

        return $this->render('chikowa/dashboard/index.html.twig', [
            'associations' => $currentUser->getAssociations(),
            'nombreTontine'=>$nombreTontine,
            'nombreMembre'=>$nombreMembre
        ]);
    }
}
