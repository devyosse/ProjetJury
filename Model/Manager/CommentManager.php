<?php
namespace App\Manager;

use App\Model\Database;
use App\Model\Entity\Comment;
use App\Model\Manager\UserManager;
use ProductManager;

class CommentManager
{
    /**
     * All articles.
     * @return array
     */
    public static function getComments(): array
    {
        $req = Database::getPDO()->prepare("SELECT * FROM comment");
        $req->execute();
        $comments = [];
        if($data = $req->fetchAll()) {
            foreach($data as $comm) {
                $author = UserManager::getUser((int)$comm['user']);
                $product = ProductManager::getProduct($comm['product']);
                $comments[] = (new Comment())
                    ->setId($comm['id'])
                    ->setContent($comm['content'])
                    ->setAuthor($author)
                    ->setProduct($product);
            }
        }

        return $comments;
    }

    /**
     * Add a new comment.
     * @param $productId
     * @param $author
     * @param $comment
     * @return void
     */
    public static function addComment($productId, $author, $comment): bool
    {
        $req = Database::getPDO()->prepare('INSERT INTO comment (content, user, product) VALUES (?, ?, ?)');
        return $req->execute([
            $comment,
            $author,
            $productId
        ]);
    }

    /**
     * Edit a comment.
     * @param $commentId
     * @param $productId
     * @param $author
     * @param $comment
     * @return void
     */
    public static function editComment($commentId, $productId, $author, $comment): bool
    {
        $req = Database::getPDO()->prepare('UPDATE comment set content=?, user=?, product=? where id=?');
        return $req->execute([
            $comment,
            $author,
            $productId,
            $commentId,
        ]);
    }

    //give back the comm with id of the article
    public static function getComment($id){
        $req = Database::getPDO()->prepare('SELECT * FROM comment WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch();
    }

    /**
     * Delete comment.
     * @param int $commentId
     * @return void
     */
    public static function deleteComment(int $commentId): bool
    {
        $stmt = Database::getPDO()->prepare("
            DELETE FROM comment WHERE id=:id
        ");

        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }
}
