<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    /**
     * @var UserInterface|null
     */
    private $currentUser;

    public function __construct(Security $security)
    {
       $this->currentUser = $security->getUser();
    }

    /**
     * @Route("/", name="news_index", methods={"GET"})
     * @param NewsRepository $newsRepository
     * @return Response
     */
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findAll();
        return $this->render('news/index.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/new", name="news_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $news = new News($this->currentUser);
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        dump($request->getContent());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_show", methods={"GET"})
     * @param News $news
     * @return Response
     */
    public function show(News $news): Response
    {
        return $this->render('news/show.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/{id}/edit", name="news_edit", methods={"GET","POST"})
     * @param Request $request
     * @param News $news
     * @return Response
     */
    public function edit(Request $request, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $news->setDateEdited(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/{id}", name="news_delete", methods={"DELETE"})
     * @param Request $request
     * @param News $news
     * @return Response
     */
    public function delete(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('news_index');
    }
}
