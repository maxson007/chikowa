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
            return $this->redirectToRoute('chikowa_association_new');
        }
        return $this->render('chikowa/dashboard/index.html.twig', [
            'associations' => $currentUser->getAssociations(),
        ]);
    }
}
