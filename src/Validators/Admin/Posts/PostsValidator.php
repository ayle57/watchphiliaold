<?php

namespace App\Validators\Admin\Posts;

use App\Http\Repository\Admin\Posts\PostsRepository;

class PostsValidator
{
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function create(string $title, string $content)
    {
        $this->validateTitle($title);
        $this->validateContent($content);

        if (empty($this->errors)) {
            $repo = new PostsRepository();
            $repo->new($title, $content);
            header('Location: /admin/posts');
            exit;
        }
    }

    public function edit(int $postId, string $newTitle, string $newContent)
    {
        $this->validateTitle($newTitle);
        $this->validateContent($newContent);

        if (empty($this->errors)) {
            $repo = new PostsRepository();
            $oldPost = $repo->selectOne('posts', 'id', $postId);

            if ($oldPost) {
                if ($oldPost->title != $newTitle || $oldPost->content != $newContent) {
                    $repo->update('posts', 'title', 'id', $postId, $newTitle);
                    $repo->update('posts', 'content', 'id', $postId, $newContent);
                    header('Location: /admin/posts/');
                    exit;
                } else {
                    $this->setErrors('Aucune mise à jour effectuée');
                }
            } else {
                $this->setErrors('Post non trouvé');
            }
        }
    }

    private function validateTitle(string $title)
    {
        if (empty($title)) {
            $this->setErrors('Veuillez entrer un nouveau titre');
        }
    }

    private function validateContent(string $content)
    {
        if (empty($content)) {
            $this->setErrors('Veuillez entrer un nouveau contenu');
        }
    }

    private function formatFrenchDate(string $dateString)
    {
        $timestamp = strtotime($dateString);
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
        return $formatter->format($timestamp);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(string $error): void
    {
        $this->errors[] = $error;
    }
}
