<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Helpers\Base\BaseController;
use App\Helpers\Base\BaseRepository;
use App\Http\Repository\Admin\Posts\PostsRepository;
use App\Validators\Admin\Posts\PostsValidator;

class PostsController extends BaseController
{
    public function index()
    {
        $posts_repo = new PostsRepository();
        $posts = $posts_repo->selectAll('posts', 'id');

        $this->render('admin/posts/index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';

            $posts_valid = new PostsValidator();
            $posts_valid->create($title, $content);

            $errors = $posts_valid->getErrors();
            if (!empty($errors)) {
                $this->render('admin/posts/create', ['errors' => $errors]);
                return;
            }

            $repo = new PostsRepository();
            $repo->new($title, $content);

            header('Location: /admin/posts');
            exit;
        }

        $this->render('admin/posts/create');
    }

    public function edit($id)
    {
        $repo = new PostsRepository();
        $post = $repo->selectOne('posts', 'id', $id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newTitle = $_POST['title'] ?? '';
            $newContent = $_POST['content'] ?? '';

            $validator = new PostsValidator();
            $validator->edit($post->id, $newTitle, $newContent);

            $errors = $validator->getErrors();
            if (!empty($errors)) {
                $this->render('admin/posts/edit', ['errors' => $errors, 'post' => $post]);
                return;
            }

            $repo->update('posts', 'title', 'id', $post->id, $newTitle);
            $repo->update('posts', 'content', 'id', $post->id, $newContent);

            header('Location: /admin/posts/');
            exit;
        }

        $validator = new PostsValidator();
        $errors = $validator->getErrors();

        $this->render('admin/posts/edit', [
            'errors' => $errors,
            'post' => $post
        ]);
    }

    public function delete($id)
    {
        $posts_repo = new PostsRepository();
        $post = $posts_repo->delete('posts', 'id', $id);
        header('Location: /admin/posts');
        exit;
    }

    public function show($id)
    {
        $base_repo = new BaseRepository();
        $post = $base_repo->selectOne('posts', 'id', $id);
        $this->render('posts/show', [
            'post' => $post
        ]);
    }

    public function all()
    {
        $postsRepo = new PostsRepository();
        $posts = $postsRepo->selectAll('posts', 'id');
        $this->render('posts/all', [
            'posts' => $posts
        ]);
    }
}
