<?php

use App\Controller\AbstractController;
use App\Manager\CommentManager;

class CommentController extends AbstractController
{

    /**
     * All comments
     * @return void
     */
    public function index()
    {
        // No indexes for comments.
    }

    /**
     * Add a new comment.
     * @return void
     */
    public function addComment()
    {
        $this->redirectIfNotConnected();
        if($this->isFormSubmitted()) {
            $user = $_SESSION['user'];
            $productId = (int)$_POST['comment-article'];
            $content = $this->getFormField('content');
            if(strlen($content) <= 10){
                $_SESSION['errors'][] = "Le contenu de l'article est trop petit.";
            }
            if(CommentManager::addComment($productId, $user->getId(), $content)){
                $_SESSION['success'][] = "Votre commentaire a bien été ajouté, merci";
            }
        }

        $this->render('comment/add-comment.php', [
            'products' => ProductManager::getAllProducts(),
        ]);
    }

    /**
     * Edit a comment.
     * @param int $id
     * @return void
     */
    public function editComment(int $id)
    {
        $this->redirectIfNotConnected();

        if($this->isFormSubmitted()) {
            $user = $_SESSION['user'];
            $productId = (int)$_POST['comment-article'];
            $content = $this->getFormField('content');
            if(strlen($content) <= 10){
                $_SESSION['errors'][] = "Le contenu de l'article est trop petit.";
            }
            if(CommentManager::editComment($id, $productId, $user->getId(), $content)){
                $_SESSION['success'][] = "Votre commentaire a bien été modifié, merci";
            }
        }

        $this->render('comment/edit-comment.php', [
            'products' => ProductManager::getAllProducts(),
            'comment' => CommentManager::getComment($id),
        ]);
    }

    /**
     * Delete a comment.
     * @param int $id
     * @return void
     */
    public function deleteComment(int $id)
    {
        $comment = CommentManager::getComment($id);
        if(!$comment){
            $_SESSION['errors'][] = "Le produit n'existe pas";
            (new HomeController())->index();
        }

        if(AbstractController::isUserAdmin() || $comment['user'] === $_SESSION['user']->getId()) {
           if(CommentManager::deleteComment($comment['id'])) {
               $_SESSION['success'][] = "Commentaire supprimé !";
           }
           else {
               $_SESSION['error'][] = "Une erreur est survenue en supprimant le commentaire";
           }
        }
        else {
            $_SESSION['errors'][] = "Vous ne pouvez pas supprimer ce commentaire";
        }

        (new HomeController())->index();
    }

}