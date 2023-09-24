<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\PostFile;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::paginate(10);
    }

    public function createPost(array $postDetails)
    {
        $post = Post::create($postDetails);

        if (array_key_exists('file', $postDetails)) {
            /** @var \Illuminate\Http\UploadedFile $file */
            $file = $postDetails['file'];

            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $postFile = new PostFile;
            $postFile->post_id = $post->id;
            $postFile->name = $file->getClientOriginalName();
            $postFile->file_path = '/storage/'.$filePath;
            $postFile->save();
        }

        return $post;
    }

    public function updatePost(Post $post, array $newPostDetails): bool
    {
        return $post->update($newPostDetails);
    }

    public function deletePost(Post $post): void
    {
        $post->delete();
    }
}
