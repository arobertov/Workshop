<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Form\FormHandler;
use App\Repository\ArticleRepository;
use Exception;
use http\Exception\InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/")
 */
class ArticleController extends AbstractController
{

    /**
     * @var UserInterface|null
     */
    private $currentUser;

    /** @var SerializerInterface */
    private $serializer;

    private $formHandler;

    public  function  __construct(Security $security,SerializerInterface $serializer,FormHandler $formHandler)
    {
        $this->currentUser = $security->getUser();
        $this->serializer = $serializer;
        $this->formHandler = $formHandler;
    }

    /**
     * @Route("/article/list/index", name="article_index", methods={"GET"})
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("api/index" ,name="admin_article_index")
     * @param ArticleRepository $articleRepository
     * @return JsonResponse
     * @throws Exception
     */
    public function indexAdmin(ArticleRepository $articleRepository) :JsonResponse
    {
        $articles = $articleRepository->findAllArticles();
        $data = $this->serializer->serialize($articles, JsonEncoder::FORMAT);
        return new JsonResponse($data,Response::HTTP_OK,[],true);
    }

    /**
     * @Route("api/create/new", name="article_create",methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createNewArticle(Request $request)
    {
        $article = new Article();
        $requestData = json_decode($request->getContent(),true);
        $article->setAuthor($this->currentUser->getAlias());
        /**
        $form = $this->createForm(ArticleType::class,$article);

        $form->submit($requestData["form_data"]);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            dump($form->all());
            $message = 'Статията бе публикувана успешно !';
            return new JsonResponse($message,Response::HTTP_OK,[],true) ;
        }

       return new JsonResponse('error',Response::HTTP_INTERNAL_SERVER_ERROR,[],'json');
        */

        $handled = $this->formHandler->handleWithSubmit($requestData["form_data"], ArticleType::class, $article);
        dump($handled);
        try{
            if($handled instanceof Article) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($handled);
                $entityManager->flush();
            }
            else {
                return new JsonResponse(json_encode($handled),RESPONSE::HTTP_UNPROCESSABLE_ENTITY,[],'json');
            }
        } catch (Exception $e){
             return new JsonResponse($e->getMessage(),RESPONSE::HTTP_INTERNAL_SERVER_ERROR,[],'json');
        }


        $message = 'Статията бе публикувана успешно !';
        return new JsonResponse($message,Response::HTTP_OK,[],true) ;

    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("article/new", name="article_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($article->getTags() as $tag){
                $article->addTag($tag);
            }
            $article->setAuthor($this->currentUser->getAlias());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }
        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("article/{id}", name="article_show", methods={"GET"})
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("article/{id}/edit", name="article_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Article $article
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, Article $article): Response
    {
        $this->denyAccessUnlessGranted('view', $article);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article->setDateEdit(new \DateTime('now'));
            $article->setAuthor($this->currentUser->getAlias());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("article/{id}", name="article_delete", methods={"DELETE"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}
