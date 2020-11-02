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
}
