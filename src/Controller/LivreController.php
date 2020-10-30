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
    public function index()
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
        $errors = [];
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
            $errors = $this->validate($livre);
            if (empty($errors)) {
                $livreManager->update($livre);
                header('Location:/livre/show/' . $id);
            }
        }
        return $this->twig->render('livre/edit.html.twig', ['livre' => $livre,
        'anneeParution' => $anneeParution, 'moisParution' => $moisParution, 'jourParution' => $jourParution,
        'anneeLecture' => $anneeLecture, 'moisLecture' => $moisLecture, 'jourLecture' => $jourLecture,
        'errors' => $errors]);
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
        $errors = [];
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
            $errors = $this->validate($livre);
            if (empty($errors)) {
                $id = $livreManager->insert($livre);
                header('Location:/livre/show/' . $id);
            }
        }
        return $this->twig->render('livre/add.html.twig', ['errors' => $errors]);
    }

    public function validate(array $livre): array
    {
        $errors = [];
        if (empty($livre['titre'])) {
            $errors [] = 'Veuillez ajouter un titre';
        } if (empty($livre['auteur'])) {
            $errors [] = 'Veuillez rentrer un auteur';
        } if (empty($livre['isbn'])) {
            $errors [] = 'Veuillez rentrer un ISBN';
        } if (empty($livre['localisation'])) {
            $errors [] = 'Veuillez rentrer une localisation';
        } if (!empty($livre['titre']) && strlen($livre['titre']) > 50) {
            $errors [] = 'Votre titre est trop long';
        } if (!empty($livre['auteur']) && strlen($livre['auteur']) > 50) {
            $errors [] = 'Votre nom d\'auteur est trop long';
        } if (!empty($livre['isbn']) && strlen($livre['isbn']) > 13) {
            $errors [] = 'Votre ISBN est trop long';
        } if (!empty($livre['localisation']) && strlen($livre['localisation']) > 100) {
            $errors [] = 'La localisation est trop long';
        } if (!empty($livre['genre']) && strlen($livre['genre']) > 50) {
                $errors [] = 'Votre champs "genre" fait plus de 50 caractères';
        }

        return $errors ?? [];
    }

    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $livreManager = new LivreManager();
        $livreManager->delete($id);
        header('Location:/livre/index');
    }
}
