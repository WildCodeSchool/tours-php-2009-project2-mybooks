<?php

/**
 * The book table manager
 */

namespace App\Model;

use PDO;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';
    public const DATABASE_ERROR = -1;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * This method is use to insert book in this table
     * $book is a array and must have following keys :
     * titre, auteur, parution, lecture, lu, isbn,localisatioon, genre, description
     * If something goes wrong in database returns database error. If ok, return the Book id.
     * @param Book $book
     * @return int
     */
    public function insert(Book $book): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (title, author, releaseDate, hasBeenReadOn, hasBeenRead, isbn, localization, genre, description,
        ownership, friend)
        VALUES (:title, :author , :releaseDate,
        :hasBeenReadOn, :hasBeenRead, :isbn, :localization, :genre, :description, :ownership, :friend)");
        if ($statement == false) {
            return self::DATABASE_ERROR;
        }
        if (
            $statement->execute([
            "title" => $book->getTitle(),
            "author" => $book->getAuthor(),
            "releaseDate" => $book->getReleaseDate(),
            "hasBeenReadOn" => $book->getHasBeenReadOn(),
            "isbn" => $book->getIsbn(),
            "localization" => $book->getLocalization(),
            "genre" => $book->getGenre(),
            "description" => $book->getDescription(),
            "hasBeenRead" => $book->gethasBeenRead(),
            "ownership" => $book->getOwnership(),
            "friend" => $book->getFriend(),
            ])
        ) {
            return intval($this->pdo->lastInsertId());
        }
        return self::DATABASE_ERROR;
    }

    public function update(Book $book)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title` = :title, `author` = :author ,
        `releaseDate` = :releaseDate,`hasBeenReadOn` = :hasBeenReadOn, `hasBeenRead` = :hasBeenRead, `isbn` = :isbn,
        `localization` = :localization, `ownership`=:ownership, `friend`=:friend, `genre` = :genre,
        `description` = :description WHERE id=:id");
        if ($statement == false) {
            return self::DATABASE_ERROR;
        }
        if (
            $statement->execute([
            "id" => $book->getId(),
            "title" => $book->getTitle(),
            "author" => $book->getAuthor(),
            "releaseDate" => $book->getReleaseDate(),
            "hasBeenReadOn" => $book->getHasBeenReadOn(),
            "isbn" => $book->getIsbn(),
            "ownership" => $book->getOwnership(),
            "friend" => $book->getFriend(),
            "localization" => $book->getLocalization(),
            "genre" => $book->getGenre(),
            "description" => $book->getDescription(),
            "hasBeenRead" => $book->gethasBeenRead()
            ]) === false
        ) {
            return self::DATABASE_ERROR;
        }
    }

    /**
     * @return bool|int
     */
    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        if ($statement == false) {
            return self::DATABASE_ERROR;
        }
        if ($statement->bindValue('id', $id, \PDO::PARAM_INT) == false) {
            return self::DATABASE_ERROR;
        }
        if (($statement->execute()) == false) {
            return self::DATABASE_ERROR;
        }
        return $statement->execute();
    }

    /**
    * @param string $dataField
    * @param string $userSearch
    * @return array|int
    */

    public function search(string $userSearch, string $dataField)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE " . $dataField .
        " LIKE :userSearch");
        if ($statement == false) {
            return self::DATABASE_ERROR;
        }
        if ($statement->bindValue(':userSearch', '%' . $userSearch . '%', \PDO::PARAM_STR) == false) {
            return self::DATABASE_ERROR;
        }
        if (($statement->execute()) == false) {
            return self::DATABASE_ERROR;
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectByTenPerPage(int $page)
    {
        // prepared request
        $bookPerPage = 10;
        if ($page <= 0) {
            $offset = 10;
        } else {
            $offset = 10 * ($page - 1);
        }
        $statement = $this->pdo->prepare('SELECT * FROM ' . self::TABLE . ' LIMIT :limit OFFSET :offset');
        if ($statement == false) {
            return self::DATABASE_ERROR;
        }
        if ($statement->bindValue('limit', $bookPerPage, \PDO::PARAM_INT) == false) {
            return self::DATABASE_ERROR;
        }
        if ($statement->bindValue('offset', $offset, \PDO::PARAM_INT) == false) {
            return self::DATABASE_ERROR;
        };
        if (($statement->execute()) == false) {
            return self::DATABASE_ERROR;
        }
        return $statement->fetchAll();
    }
}
