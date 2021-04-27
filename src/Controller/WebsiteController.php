<?php

namespace App\Controller;

use App\Entity\Article;

use App\Entity\Category;
use Symfony\Component\Security\Core\Security;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

/**
 * @Route("/website")
 */
class WebsiteController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(CategoryRepository $categoryRepository, ArticleRepository $articleRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;

    }



    /**
     * @Route("/", name="website_index")
     *
     */
    public function index() : Response
    {
        $category = $this->categoryRepository->findAll();

        $article = $this->getDoctrine()->getRepository(Article::class);
        $banner = $article->findOneBy(['banner' => true], ['id' => 'DESC'], 1);
        $latest = $article->findBy([],['id' => 'DESC'],3);
        $trend = $article->findBy(['trending' => true],['id' => 'DESC'], 3);
        $flush = $article->findBy(['flush' => true], ['id' => 'DESC'], 3);

        $native = $article->findBy(['category' => ['type' => 1]], ['id' => 'DESC'], 5);
        $international = $article->findBy(['category' => ['type' => 2]], ['id' => 'DESC'], 5);
        $sport = $article->findBy(['category' => ['type' => 3]], ['id' => 'DESC'], 5);
        $business = $article->findBy(['category' => ['type' => 4]], ['id' => 'DESC'], 5);
        $entertainment = $article->findBy(['category' => ['type' => 5]], ['id' => 'DESC'], 5);
        $tech = $article->findBy(['category' => ['type' => 6]], ['id' => 'DESC'], 5);

        return $this->render('website/index.html.twig', array(
            'categories' => $category,
            'latests' => $latest,
            'trends' => $trend,
            'banners' => $banner,
            'flushes' => $flush,

            'natives' => $native,
            'internationals' => $international,
            'sports' => $sport,
            'businesses' => $business,
            'entertainments' => $entertainment,
            'techs' => $tech,

        ));
    }

    /**
     * @Route ("/news/{id}",name="website_post")
     * @param $id
     * @return Response
     */
    public function showArticle($id) : Response{

        $category = $this->categoryRepository->findAll();
        $flush = $this->articleRepository->findBy(['flush' => true], ['id' => 'DESC'], 1);
        $showArticle = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('website/showArticle.html.twig', [
                'categories' => $category,
                'flushes' => $flush,
                'showArticles' => $showArticle,
        ]);
    }

    /**
     * @Route ("/category/{id}",name="website_category")
     * @param $id
     * @return Response
     */
    public function articleCategory($id) : Response{
        $articleByCategory = $this->articleRepository->findBy(['category' => $id]);
        $category = $this->categoryRepository->findAll();
        $flush = $this->articleRepository->findBy(['flush' => true], ['id' => 'DESC'], 1);

        return $this->render('website/articleCategory.html.twig', array(
            'articleByCategories' => $articleByCategory,
            'categories' => $category,
            'flushes' => $flush,
        ));
    }

    /**
     * @Route ("/contact", name="website_contact")
     */
    public function doContact(): Response {

        $category = $this->categoryRepository->findAll();
        $flush = $this->articleRepository->findBy(['flush' => true], ['id' => 'DESC'], 1);

        return $this->render('website/contactus.html.twig', array(
            'categories' => $category,
            'flushes' => $flush,
        ));
    }
}

