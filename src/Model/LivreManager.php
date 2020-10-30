<?php
namespace App\Model;

use PDO;


class LivreManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'livre';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $livre
     * @return int
     */
    public function insert(array $livre): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (titre, auteur, parution,
        lecture, lu, isbn, localisation, genre, description) VALUES (:titre, :auteur , :parution,
        :lecture, :lu, :isbn, :localisation, :genre, :description)");
        $statement->bindValue('titre', $livre['titre'], PDO::PARAM_STR);
        $statement->bindValue('auteur', $livre['auteur'], PDO::PARAM_STR);
        $statement->bindValue('parution', $livre['parution'], PDO::PARAM_STR);
        $statement->bindValue('lecture', $livre['lecture'], PDO::PARAM_STR);
        $statement->bindValue('lu', $livre['lu'], PDO::PARAM_BOOL);
        $statement->bindValue('isbn', $livre['isbn'], PDO::PARAM_STR);
        $statement->bindValue('localisation', $livre['localisation'], PDO::PARAM_STR);
        $statement->bindValue('genre', $livre['genre'], PDO::PARAM_STR);
        $statement->bindValue('description', $livre['description'], PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $livre
     * @return bool
     */
    public function update(array $livre): bool
    {
    
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `titre` = :titre, `auteur` = :auteur ,
         `parution` = :parution,`lecture` = :lecture, `lu` = :lu, `isbn` = :isbn, 
         `localisation` = :localisation, `genre` = :genre, `description` = :description WHERE id=:id");
        $statement->bindValue('id', $livre['id'], PDO::PARAM_INT);
        $statement->bindValue('titre', $livre['titre'], PDO::PARAM_STR);
        $statement->bindValue('auteur', $livre['auteur'], PDO::PARAM_STR);
        $statement->bindValue('parution', $livre['parution'], PDO::PARAM_STR);
        $statement->bindValue('lecture', $livre['lecture'], PDO::PARAM_STR);
        $statement->bindValue('lu', $livre['lu'], PDO::PARAM_STR);
        $statement->bindValue('isbn', $livre['isbn'], PDO::PARAM_STR);
        $statement->bindValue('localisation', $livre['localisation'], PDO::PARAM_STR);
        $statement->bindValue('genre', $livre['genre'], PDO::PARAM_STR);
        $statement->bindValue('description', $livre['description'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
