<?php

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tags_ids = $this->getTagIds($tags);
            $data['category_id'] = $this->getCategoryId($category);

            $post = Post::create($data);
            $post->tags()->attach($tags_ids);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }


        return $post;
    }
    public function update($post, $data)
    {
        try {
            DB::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tags_ids = $this->getTagIdsWithUpdate($tags);
            $data['category_id'] = $this->getCategoryIdWithUpdate($category);

            $post->update($data);
            $post->tags()->sync($tags_ids);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post->fresh();
    }
    private function getTagIds($tags)
    {
        $tag_ids = [];

        foreach ($tags as $tag) {
            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
            $tag_ids[] = $tag->id;
        }

        return $tag_ids;
    }
    private function getTagIdsWithUpdate($tags)
    {
        $tag_ids = [];

        foreach ($tags as $tag) {
            if (!isset($tag['id'])) {
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $currentTag->fresh();
            }

            $tag_ids[] = $tag['id'];
        }

        return $tag_ids;
    }
    private function getCategoryId($item)
    {
        $category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
    }
    private function getCategoryIdWithUpdate($item)
    {
        if (!isset($item['id'])) {
            $category = Category::create($item);
        } else {
            $category = Category::find($item['id']);
            $category->update($item);
            $category = $category->fresh();
        }

        return $category->id;
    }
}