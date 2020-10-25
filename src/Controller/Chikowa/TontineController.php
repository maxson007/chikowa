<?php

namespace App\Controller\Chikowa;

use App\Entity\Chikowa\Tontine;
use App\Form\Chikowa\TontineType;
use App\Repository\Chikowa\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chikowa/tontine")
 */
class TontineController extends AbstractController
{
    /**
     * @Route("/", name="chikowa_tontine_index", methods={"GET"})
     */
    public function index(TontineRepository $tontineRepository): Response
    {
        return $this->render('chikowa/tontine/index.html.twig', [
            'tontines' => $tontineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chikowa_tontine_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tontine = new Tontine();
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tontine);
            $entityManager->flush();

            return $this->redirectToRoute('chikowa_tontine_index');
        }

        return $this->render('chikowa/tontine/new.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_tontine_show", methods={"GET"})
     */
    public function show(Tontine $tontine): Response
    {
        return $this->render('chikowa/tontine/show.html.twig', [
            'tontine' => $tontine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chikowa_tontine_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tontine $tontine): Response
    {
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chikowa_tontine_index');
        }

        return $this->render('chikowa/tontine/edit.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_tontine_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tontine $tontine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tontine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tontine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chikowa_tontine_index');
    }
}
