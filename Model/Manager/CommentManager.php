<?php
namespace App\Manager;

use App\Model\Database;

class CommentManager
{


//add a comment in a article of exist
    public static function addComment($articleId, $author, $comment){
        $req = Database::getPDO()->prepare('INSERT INTO comment (articleId, author, comment, date) VALUES (?, ?, ?, NOW())');
        $req->execute(array($articleId, $author, $comment));
        $req->closeCursor();
    }

//give back the comm with id of the article
    public static function getComments($id){
        $req = Database::getPDO()->prepare('SELECT * FROM comment WHERE articleId = ?');
        $req->execute(array($id));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
    }
}
