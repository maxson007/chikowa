<?php

namespace App\Controller\Chikowa;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/chikowa/dashboard", name="chikowa_dashboard")
     */
    public function index()
    {
        return $this->render('chikowa/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
