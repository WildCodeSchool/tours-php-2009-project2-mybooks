<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\LivreManager;

/**
 * Class LivreController
 *
 */
class LivreController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $itemManager = new LivreManager();
        $livres = $itemManager->selectAll();

        return $this->twig->render('Livre/index.html.twig', ['livres' => $livres]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $itemManager = new LivreManager();
        $livre = $itemManager->selectOneById($id);

        return $this->twig->render('Livre/show.html.twig', ['livre' => $livre]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $itemManager = new LivreManager();
        $livre = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livre = [
                'id' => $_POST['id'],
                'titre' => $_POST['titre'],
                'auteur' => $_POST['auteur'],
                'parution' => $_POST['parution'],
                'lecture' => $_POST['lecture'],
                'lu' => $_POST['lu'],
                'isbn' => $_POST['isbn'],
                'localisation' => $_POST['localisation'],
                'genre' => $_POST['genre'],
                'description' => $_POST['description'],
                
            ];
            $itemManager->update($livre);
        }

        return $this->twig->render('Livre/edit.html.twig', ['livre' => $livre]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if (!isset($_POST['lu'])) {
            $_POST['lu'] = '0';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemManager = new LivreManager();
            $livre = [
                'titre' => $_POST['titre'],
                'auteur' => $_POST['auteur'],
                'parution' => $_POST['parution'],
                'lecture' => $_POST['lecture'],
                'lu' => $_POST['lu'],
                'isbn' => $_POST['isbn'],
                'localisation' => $_POST['localisation'],
                'genre' => $_POST['genre'],
                'description' => $_POST['description'],

            ];

            $id = $itemManager->insert($livre);
            header('Location:/Livre/show/' . $id);
        }

        return $this->twig->render('Livre/add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $itemManager = new LivreManager();
        $itemManager->delete($id);
        header('Location:/Livre/index');
    }
}
