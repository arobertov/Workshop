<?php

namespace App\Controller;

use App\Entity\SpiritualPearls;
use App\Form\SpiritualPearlsType;
use App\Repository\SpiritualPearlsRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/spiritual/pearls")
 */
class SpiritualPearlsController extends AbstractController
{
    /**
     * @var UserInterface|null
     */
    private $currentUser;

    /**
     * SpiritualPearlsController constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->currentUser = $security->getUser();
    }

    /**
     * @Route("/", name="spiritual_pearls_index", methods={"GET"})
     * @param SpiritualPearlsRepository $spiritualPearlsRepository
     * @return Response
     */
    public function index(SpiritualPearlsRepository $spiritualPearlsRepository): Response
    {
        return $this->render('spiritual_pearls/index.html.twig', [
            'spiritual_pearls' => $spiritualPearlsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="spiritual_pearls_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $spiritualPearl = new SpiritualPearls($this->currentUser);
        $form = $this->createForm(SpiritualPearlsType::class, $spiritualPearl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spiritualPearl);
            $entityManager->flush();

            return $this->redirectToRoute('spiritual_pearls_index');
        }

        return $this->render('spiritual_pearls/new.html.twig', [
            'spiritual_pearl' => $spiritualPearl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spiritual_pearls_show", methods={"GET"})
     * @param SpiritualPearls $spiritualPearl
     * @return Response
     */
    public function show(SpiritualPearls $spiritualPearl): Response
    {
        return $this->render('spiritual_pearls/show.html.twig', [
            'spiritual_pearl' => $spiritualPearl,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spiritual_pearls_edit", methods={"GET","POST"})
     * @param Request $request
     * @param SpiritualPearls $spiritualPearl
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, SpiritualPearls $spiritualPearl): Response
    {
        $form = $this->createForm(SpiritualPearlsType::class, $spiritualPearl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $spiritualPearl->setDateEdited(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spiritual_pearls_index');
        }

        return $this->render('spiritual_pearls/edit.html.twig', [
            'spiritual_pearl' => $spiritualPearl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spiritual_pearls_delete", methods={"DELETE"})
     * @param Request $request
     * @param SpiritualPearls $spiritualPearl
     * @return Response
     */
    public function delete(Request $request, SpiritualPearls $spiritualPearl): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spiritualPearl->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spiritualPearl);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spiritual_pearls_index');
    }
}
