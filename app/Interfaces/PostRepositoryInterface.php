<?php

namespace App\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAllPosts();

    public function createPost(array $postDetails);

    public function updatePost(Post $post, array $newPostDetails);

    public function deletePost(Post $post);
}
