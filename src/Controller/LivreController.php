<?php

namespace App\Controller;

use App\Model\LivreManager;

/**
 * Class livreController
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
    public function index(): string
    {
        $livreManager = new LivreManager();
        $livres = $livreManager->selectAll();

        return $this->twig->render('livre/index.html.twig', ['livres' => $livres]);
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
        $livreManager = new LivreManager();
        $livre = $livreManager->selectOneById($id);

        return $this->twig->render('livre/show.html.twig', ['livre' => $livre]);
    }

    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add(): string
    {
        $emptyErrors = [];
        $tooLongErrors = [];
        if (!isset($_POST['lu'])) {
            $_POST['lu'] = '0';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livreManager = new LivreManager();
            $livre = [
                'titre' => $_POST['titre'],
                'auteur' => $_POST['auteur'],
                'parution' => $_POST['anneeParution'] . '-' . $_POST['moisParution'] . '-' . $_POST['jourParution'],
                'lecture' => $_POST['anneeLecture'] . '-' . $_POST['moisLecture'] . '-' . $_POST['jourLecture'],
                'lu' => $_POST['lu'],
                'isbn' => $_POST['isbn'],
                'localisation' => $_POST['localisation'],
                'genre' => $_POST['genre'],
                'description' => $_POST['description'],
            ];
            $emptyErrors = $this->isEmpty($livre);
            $tooLongErrors = $this->isTooLong($livre);
            if (empty($emptyErrors) && empty($tooLongErrors)) {
                $id = $livreManager->insert($livre);
                header('Location:/livre/show/' . $id);
            }
        }
        return $this->twig->render('livre/add.html.twig', ['emptyErrors' => $emptyErrors,
            'tooLongErrors' => $tooLongErrors]);
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
        $emptyErrors = [];
        $tooLongErrors = [];
        $livreManager = new LivreManager();
        $livre = $livreManager->selectOneById($id);

        $dateParutionArray = explode('-', $livre['parution']);
        $anneeParution = $dateParutionArray[0];
        $moisParution = $dateParutionArray[1];
        $jourParution = $dateParutionArray[2];

        $dateLectureArray = explode('-', $livre['lecture']);
        $anneeLecture = $dateLectureArray[0];
        $moisLecture = $dateLectureArray[1];
        $jourLecture = $dateLectureArray[2];

        if (!isset($_POST['lu'])) {
            $_POST['lu'] = '0';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $livre = [
                'id' => $_POST['id'],
                'titre' => $_POST['titre'],
                'auteur' => $_POST['auteur'],
                'parution' => $_POST['anneeParution'] . '-' . $_POST['moisParution'] . '-' . $_POST['jourParution'],
                'lecture' => $_POST['anneeLecture'] . '-' . $_POST['moisLecture'] . '-' . $_POST['jourLecture'],
                'lu' => $_POST['lu'],
                'isbn' => $_POST['isbn'],
                'localisation' => $_POST['localisation'],
                'genre' => $_POST['genre'],
                'description' => $_POST['description'],

            ];
            $emptyErrors = $this->isEmpty($livre);
            $tooLongErrors = $this->isTooLong($livre);
            if (empty($emptyErrors) && empty($tooLongErrors)) {
                $livreManager->update($livre);
                header('Location:/livre/show/' . $id);
            }
        }
        return $this->twig->render('livre/edit.html.twig', ['livre' => $livre,
            'anneeParution' => $anneeParution, 'moisParution' => $moisParution, 'jourParution' => $jourParution,
            'anneeLecture' => $anneeLecture, 'moisLecture' => $moisLecture, 'jourLecture' => $jourLecture,
            'emptyErrors' => $emptyErrors, 'tooLongErrors' => $tooLongErrors]);
    }

    public function isEmpty(array $livre): array
    {
        $emptyErrors = [];
        if (empty($livre['titre'])) {
            $emptyErrors ['titre'] = 'Veuillez ajouter un titre';
        }
        if (empty($livre['auteur'])) {
            $emptyErrors ['auteur'] = 'Veuillez rentrer un auteur';
        }
        if (empty($livre['isbn'])) {
            $emptyErrors ['isbn'] = 'Veuillez rentrer un ISBN';
        }
        if (empty($livre['localisation'])) {
            $emptyErrors ['localisation'] = 'Veuillez rentrer une localisation';
        }
        return $emptyErrors;
    }
    public function isTooLong(array $livre): array
    {
        $tooLongErrors = [];
        if (strlen($livre['titre']) > 50) {
            $tooLongErrors ['titre'] = 'Votre titre est trop long';
        }
        if (strlen($livre['auteur']) > 50) {
            $tooLongErrors ['auteur'] = 'Votre nom d\'auteur est trop long';
        }
        if (strlen($livre['isbn']) > 13) {
            $tooLongErrors ['isbn'] = 'Votre ISBN est trop long';
        }
        if (strlen($livre['localisation']) > 100) {
            $tooLongErrors ['localisation'] = 'La localisation est trop long';
        }
        if (!empty($livre['genre']) && strlen($livre['genre']) > 50) {
            $tooLongErrors ['genre'] = 'Votre champs "genre" fait plus de 50 caractères';
        }
        return $tooLongErrors;
    }
}
