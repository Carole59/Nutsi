<?php

    namespace App\Controller;

    use App\Entity\Article;

    use App\Form\ArticleType;

    use App\Repository\ArticleRepository;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;

    class ArticleController extends AbstractController
    {
        /**
         * @Route("/articles", name="articles")
         * @param ArticleRepository $articleRepository
         * @return Response
         */
        //methode qui me permet de faire un select en BDD de l'ensemble de mes champs
        //dans
        public function article(ArticleRepository $articleRepository)
        {

            // je cherche mes fichiers où, dans le repository
            //les repository en general servent à faire les requêtes select dans les tables
            $articles = $articleRepository->findAll();

            //render me permet d'afficher mes recherches et où je dois les trouver
            return $this->render('article/article.html.twig', [
                'articles' => $articles
            ]);
        }
    //.........................................................................
    //.........................................................................
        /**
         * @Route("/article", name="article")
         * @param ArticleRepository $articleRepository
         * @return Response
         */
        public function getByArticle(ArticleRepository $articleRepository)
        {
            //Appelle le articleRepository(en le passant en paramètre de la méthode
            //appelle la méthode que l'on a créée dans articleRepository ("getByArticle()")
            //cette méthode est sensée  nous retourner l'article des articles en fonction d'un mot
            //elle va donc exécuter une requête SELECT en BDD

            //j'appelle la méthode getByWorld de mon repository la variable "word"
            $article = $articleRepository->getByName();
            dump($article);

    //PERMET D'AFFICHER MES RECHERCHES OÙ JE DOIS LES TROUVER
            return $this->render('article/article.html.twig', [
                'article' => $article
            ]);
        }
    //..................................................................................
    //.................................................................................
        /**
         * @Route("/article/show/{id}", name="article")
         * @param ArticleRepository $articleRepository
         * @param $id
         * @return Response
         */
        public function getArticleById(ArticleRepository $articleRepository,$id)
        {
            //articleRepository contient une instance de la classe 'ArticleRepository'
            //génralement on obtient une instance de la classe (ou un objet) en utilisant le mot-clé "new"
            //ici, grace a Symfony , on obtient l'instance de la classe repository en la passant simplement en paramètre
            $article = $articleRepository->find($id);

            return $this->render('article/article.html.twig',['article' =>$article]);
        }


//..................................................................................
//.................................................................................
        /**
         * @Route("/admin/article/delete/{id}", name="article_delete")
         * @param ArticleRepository $articleRepository
         * @param EntityManagerInterface $entityManager
         * @param $id
         * @return Response
         */

        public function deleteArticle(ArticleRepository $articleRepository, EntityManagerInterface $entityManager, $id)
        {
// Je récupère un enregistrement auteur en BDD grâce au repository de article


            $article = $articleRepository->find($id);

// j'utilise l'entity manager avec la méthode remove pour enregistrer
// la suppression d'un article dans l'unité de travail
            $entityManager->remove($article);

// je valide la suppression en bdd avec la méthode flush
            $entityManager->flush();

            return $this->render('article/delete.html.twig', [
                'article' => $article
            ]);
        }
//................................................................

        /**
         * @Route("/admin/article/insert", name="article/insert_form")
         * @param Request $request
         * @param EntityManagerInterface $entityManager
         * @return Response
         */
        public function insertArticleForm(Request $request, EntityManagerInterface $entityManager){
            //je crée un nouvel article
            //j'utilise le gabarit(builder) de formulaire pour créer mon formulaire
            //j'envoid mon formulaire à un fichier twig
            //et je l'affiche


            $article = new article;
            //j'utilise la méthode createForm pour céer le gabarit de formulaire
            //pour l'article : articleType (que j'ai généré en ligne de commandes)
            // Et je lui associe mon entité Article vide

            $articleForm = $this->createForm(articleType::class, $article);


            if ($request->isMethod('Post')) {

                $articleForm->handleRequest($request);

                if ($articleForm->isValid()) {

                    $entityManager->persist($article);
                    $entityManager->flush();

                }
            }

            //à partir de mon gabarit, je crée la vue de mon formulaire

            $articleFormView = $articleForm->createView();

            return $this->render('article/insert_form.html.twig', [
                'articleFormView' => $articleFormView
            ]);
        }
        //................................................................

        /**
         * @Route("/admin/article/delete/{id}", name="article_delete")
         * @param ArticleRepository $articleRepository
         * @param Request $request
         * @param EntityManagerInterface $entityManager
         * @param $id
         * @return Response
         */
        public function updateArticleForm(ArticleRepository $articleRepository, Request $request, EntityManagerInterface $entityManager, $id)
        {
            $article = $articleRepository->find($id);
            $articleForm = $this->createForm(ArticleType::class, $article);

            if ($request->isMethod('Post'))
            {
                $articleForm->handleRequest($request);
                if ($articleForm->isValid()) {
                    $entityManager->persist($article);
                    $entityManager->flush();
                }
            }
            // à partir de mon gabarit, je crée la vue de mon formulaire
            $articleFormView = $articleForm->createView();
            // je retourne un fichier twig, et je lui envoie ma variable qui contient
            // mon formulaire
            return $this->render('article/insert_form.html.twig', [
                'articleFormView' => $articleFormView
            ]);
        }}
