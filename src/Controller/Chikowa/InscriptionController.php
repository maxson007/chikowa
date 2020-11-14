<?php

namespace App\Controller\Chikowa;

use App\Entity\Chikowa\Association;
use App\Entity\Chikowa\Inscription;
use App\Entity\Chikowa\Tontine;
use App\Form\Chikowa\InscriptionType;
use App\Repository\Chikowa\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/chikowa/inscription")
 */
class InscriptionController extends AbstractController
{
    /**
     * @Route("/", name="chikowa_inscription_index", methods={"GET"})
     * @param InscriptionRepository $inscriptionRepository
     * @return Response
     */
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('chikowa/inscription/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/tontine/{id}/new", name="chikowa_inscription_new", methods={"GET","POST"})
     * @param Tontine $tontine
     * @param Request $request
     * @return Response
     */
    public function inscrireMembre(Tontine $tontine ,Request $request): Response
    {
        $inscription = new Inscription();
        $inscription->setTontine($tontine);
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist(s);
            $entityManager->flush();

            return $this->redirectToRoute('chikowa_inscription_index');
        }

        return $this->render('chikowa/inscription/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_inscription_show", methods={"GET"})
     */
    public function show(Inscription $inscription): Response
    {
        return $this->render('chikowa/inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chikowa_inscription_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscription $inscription): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chikowa_inscription_index');
        }

        return $this->render('chikowa/inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_inscription_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscription $inscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chikowa_inscription_index');
    }
}
