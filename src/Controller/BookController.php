<?php

namespace App\Controller;

use App\Model\BookManager;
use App\Model\Book;

/**
 * Class bookController
 *
 */
class BookController extends AbstractController
{
    /**
     * Display book listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): string
    {
        $bookManager = new BookManager();
        $books = $bookManager->selectAll();

        return $this->twig->render('book/index.html.twig', ['books' => $books]);
    }

    /**
     * Display book informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $bookManager = new BookManager();
        $book = $bookManager->selectOneById($id);
        return $this->twig->render('book/show.html.twig', ['book' => $book]);
    }

    /**
     * Add book in DB
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $read = 'Oui';
            if (!isset($_POST['hasBeenRead'])) {
                $read = 'Non';
            }
            $bookManager = new BookManager();
            $book = new Book();
            $book->setTitle($_POST['title']);
            $book->setAuthor($_POST['author']);
            $book->setGenre($_POST['genre']);
            $book->setLocalization($_POST['localization']);
            $book->setHasBeenRead($read);
            $book->setReleaseDate($_POST['releaseDate']);
            $book->setDescription($_POST['description']);
            $book->setIsbn($_POST['isbn']);
            $book->setHasBeenReadOn($_POST['hasBeenReadOn']);
            if ($book->isValid()) {
                $id = $bookManager->insert($book);
                header('Location:/book/show/' . $id);
                return "";
            } else {
                $errors = $book->getErrors();
                $bookArray = $bookManager->selectAll();
                $bookArray['title'] = $_POST['title'];
                $bookArray['author'] = $_POST['author'];
                $bookArray['genre'] = $_POST['genre'];
                $bookArray['localization'] = $_POST['localization'];
                $bookArray['releaseDate'] = $_POST['releaseDate'];
                $bookArray['description'] = $_POST['description'];
                $bookArray['isbn'] = $_POST['isbn'];
                $bookArray['hasBeenReadOn'] = $_POST['hasBeenReadOn'];
                $bookArray['hasBeenRead'] = $read;
                return $this->twig->render('book/add.html.twig', ["today" => date('Y-m-d'), 'book_array' => $bookArray,'errors' => $errors]);
                
               
            
            }
        }
        return $this->twig->render('book/add.html.twig', ["today" => date('Y-m-d'),'errors' => $errors]);
    }

    public function edit(int $id)
    {
        $errors = [];
        $bookManager = new BookManager();
        $bookArray = $bookManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $read = 'Oui';
            if (!isset($_POST['hasBeenRead'])) {
                $read = 'Non';
            }
            $book = new Book();
            $book->setId($_POST['id']);
            $book->setTitle($_POST['title']);
            $book->setAuthor($_POST['author']);
            $book->setGenre($_POST['genre']);
            $book->setLocalization($_POST['localization']);
            $book->setHasBeenRead($read);
            $book->setReleaseDate($_POST['releaseDate']);
            $book->setDescription($_POST['description']);
            $book->setIsbn($_POST['isbn']);
            $book->setHasBeenReadOn($_POST['hasBeenReadOn']);
            if ($book->isValid()) {
                $bookManager->update($book);
                header('Location:/book/show/' . $id);
                return "";
            } else {
                $errors = $book->getErrors();
            }
        }
        return $this->twig->render('book/edit.html.twig', ['book_array' => $bookArray, 'errors' => $errors]);
    }

    public function delete($id)
    {
        $bookManager = new BookManager();
        $bookManager->delete($id);
        header('Location:/');
    }
}
