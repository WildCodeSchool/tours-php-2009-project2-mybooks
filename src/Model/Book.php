<?php

namespace App\Model;

class Book extends BookManager
{
    private $id;
    private $title;
    private $author;
    private $genre;
    private $localization;
    private $hasBeenRead;
    private $releaseDate;
    private $description;
    private $isbn;
    private $hasBeenReadOn;
    private $errors;

    /**
     * @return int
     */

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Book
     */
    public function setId(int $id): Book
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Book
     */
    public function setTitle(string $title): Book
    {
        if (empty($title)) {
            $this->errors ['title'] = 'Veuillez ajouter un titre';
        } elseif (strlen($title) > 50) {
            $this->errors ['title'] = 'Votre champ "titre" est trop long';
        } else {
            $this->title = $title;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Book
     */
    public function setAuthor(string $author): Book
    {
        if (empty($author)) {
            $this->errors ['author'] = 'Veuillez ajouter un auteur';
        } elseif (strlen($author) > 50) {
            $this->errors ['author'] = 'Votre champ "auteur" est trop long';
        } else {
            $this->author = $author;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return Book
     */
    public function setGenre(string $genre): Book
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    /**
     * @param string $localization
     * @return Book
     */
    public function setLocalization(string $localization): Book
    {
        if (empty($localization)) {
            $this->errors ['localization'] = 'Veuillez ajouter une localisation';
        } elseif (strlen($localization) > 100) {
            $this->errors ['localization'] = 'Votre champ "localisation" contient trop de caractère';
        } else {
            $this->localization = $localization;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getHasBeenRead(): ?string
    {
        return $this->hasBeenRead;
    }

    /**
     * @param string $hasBeenRead
     * @return Book
     */
    public function setHasBeenRead(string $hasBeenRead): Book
    {
        $this->hasBeenRead = $hasBeenRead;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     * @return Book
     */
    public function setReleaseDate(?string $releaseDate): Book
    {
        if ($releaseDate == "") {
            $releaseDate = null;
        }
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Book
     */
    public function setDescription(string $description): Book
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return Book
     */
    public function setIsbn(string $isbn): Book
    {
        if (empty($isbn)) {
            $this->errors ['isbn'] = 'Veuillez ajouter un ISBN';
        } elseif (strlen($isbn) > 13) {
            $this->errors ['isbn'] = 'Votre ISBN est trop long';
        } else {
            $this->isbn = $isbn;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getHasBeenReadOn(): ?string
    {
        return $this->hasBeenReadOn;
    }

    /**
     * @param string $hasBeenReadOn
     * @return Book
     */
    public function setHasBeenReadOn(?string $hasBeenReadOn): Book
    {
        if ($hasBeenReadOn == "") {
            $hasBeenReadOn = null;
        }
        $this->hasBeenReadOn = $hasBeenReadOn;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return empty($this->errors);
    }
}
