<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use Illuminate\Console\Command;

class import_json_placeholder_command extends Command
{
    protected $signature = 'import:json_placeholder';
    protected $description = 'Get data from jsonplaceholder';

    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posts');
        $data = json_decode($response->getBody()->getContents());

        foreach ($data as $post) {
            Post::firstOrCreate([
                'title' => $post->title
            ], [
                'title' => $post->title,
                'content' => $post->body,
                'category_id' => 2,
            ]);
        }

        dd('finish');

    }
}
