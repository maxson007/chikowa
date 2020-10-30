<?php

namespace App\Controller\Chikowa;

use App\Entity\Chikowa\Association;
use App\Entity\Chikowa\Membre;
use App\Entity\ChikowaUser;
use App\Form\Chikowa\TontineAddMembreType;
use App\Form\Chikowa\AssociationType;
use App\Form\Chikowa\MembreType;
use App\Repository\Chikowa\AssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chikowa/association")
 */
class AssociationController extends AbstractController
{
    /**
     * @Route("/", name="chikowa_association_index", methods={"GET"})
     */
    public function index(AssociationRepository $associationRepository): Response
    {
        /** @var ChikowaUser $user */
        $user = $this->getUser();
        if ($user->getAssociations()->isEmpty()) {
            $this->redirectToRoute('chikowa_association_new');
        }
        return $this->render('chikowa/association/choice_association_index.html.twig', [
            'associations' => $user->getAssociations(),
        ]);

    }

    /**
     * @Route("/new", name="chikowa_association_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $association = new Association();
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $localisation = $association->getLocalisation();
            $address = explode("-->", $localisation);
            if ($address) {
                $association->setLocalisation($address[0]);
                $association->setPlaceId($address[1]);
            }
            $association->addGestionaire($this->getUser());
            $entityManager->persist($association);
            $entityManager->flush();

            $this->addFlash(
                'success',
                sprintf("L'asociation %s est enregistré avec succès", $association->getLibelle())
            );
            return $this->redirectToRoute('chikowa_dashboard');
        }
        return $this->render('chikowa/association/new.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_association_show", methods={"GET"})
     */
    public function show(Association $association): Response
    {
        return $this->render('chikowa/association/show.html.twig', [
            'association' => $association,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chikowa_association_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Association $association): Response
    {
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $localisation = $association->getLocalisation();
            $address = explode("-->", $localisation);
            dump($address);
            if ($address) {
                $association->setLocalisation($address[0]);
                $association->setPlaceId($address[1]);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chikowa_association_index');
        }

        return $this->render('chikowa/association/edit.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chikowa_association_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Association $association): Response
    {
        if ($this->isCsrfTokenValid('delete' . $association->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($association);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chikowa_association_index');
    }

}
