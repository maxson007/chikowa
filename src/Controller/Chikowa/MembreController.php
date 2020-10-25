<?php

namespace App\Controller\Chikowa;

use App\Entity\Chikowa\Membre;
use App\Entity\ChikowaUser;
use App\Form\Chikowa\MembreType;
use App\Repository\Chikowa\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chikowa/membre")
 */
class MembreController extends AbstractController
{
    /**
     * @Route("/", name="chikowa_membre_index", methods={"GET"})
     */
    public function index(MembreRepository $membreRepository): Response
    {
        /** @var ChikowaUser $user */
        $user=$this->getUser();
        return $this->render('chikowa/membre/index.html.twig', [
            'associations' =>$user->getAssociations(),
        ]);
    }

    /**
     * @Route("/new", name="chikowa_membre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();

            return $this->redirectToRoute('chikowa_membre_index');
        }

        return $this->render('chikowa/membre/new.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_membre_show", methods={"GET"})
     */
    public function show(Membre $membre): Response
    {
        return $this->render('chikowa/membre/show.html.twig', [
            'membre' => $membre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chikowa_membre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Membre $membre): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chikowa_membre_index');
        }

        return $this->render('chikowa/membre/edit.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_membre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Membre $membre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chikowa_membre_index');
    }
}
