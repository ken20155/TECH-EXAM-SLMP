<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Todo;
use App\Models\UserAddress;
use App\Models\UserCompany;

class FetchJsonPlaceholder extends Command
{
    protected $signature = 'fetch:json';
    protected $description = 'Fetch data from JSONPlaceholder API';
    private $external_api_url;
    function __construct() {
        parent::__construct();
        $this->external_api_url = config('app.external_api_url');
    }
    public function handle()
    {
        
        $this->fetchUsers();
        $this->fetchPosts();
        $this->fetchComments();
        $this->fetchAlbums();
        $this->fetchPhotos();
        $this->fetchTodos();
        $this->info('All data fetched successfully!');
    }
    private function fetchUsers(): void {
        $this->info('Fetching users...');
        $users = Http::withoutVerifying()->get($this->external_api_url . '/users')->json();
        foreach ($users as $user) {

            $userModel = User::updateOrCreate(
                ['external_id' => $user['id']],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'password' => Hash::make($user['username']),
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'website' => $user['website'],
                ]
            );

            // ADDRESS
            if (isset($user['address'])) {
                UserAddress::updateOrCreate(
                    ['user_id' => $userModel->id],
                    [
                        'street' => $user['address']['street'] ?? null,
                        'suite' => $user['address']['suite'] ?? null,
                        'city' => $user['address']['city'] ?? null,
                        'zipcode' => $user['address']['zipcode'] ?? null,
                        'lat' => $user['address']['geo']['lat'] ?? null,
                        'lng' => $user['address']['geo']['lng'] ?? null,
                    ]
                );
            }

            // COMPANY
            if (isset($user['company'])) {
                UserCompany::updateOrCreate(
                    ['user_id' => $userModel->id],
                    [
                        'name' => $user['company']['name'] ?? null,
                        'catch_phrase' => $user['company']['catchPhrase'] ?? null,
                        'bs' => $user['company']['bs'] ?? null,
                    ]
                );
            }
        }
    }
    private function fetchPosts(): void {
        $this->info('Fetching posts...');

        $posts = Http::withoutVerifying()->get($this->external_api_url . '/posts')->json();

        foreach ($posts as $post) {
            $user = User::where('external_id', $post['userId'])->first();

            if ($user) {
                Post::updateOrCreate(
                    ['external_id' => $post['id']],
                    [
                        'user_id' => $user->id,
                        'title' => $post['title'],
                        'body' => $post['body'],
                    ]
                );
            }
        }

    }
    private function fetchComments(): void {
        $this->info('Fetching comments...');
        $comments = Http::withoutVerifying()->get($this->external_api_url . '/comments')->json();
        foreach ($comments as $comment) {
            $post = Post::where('external_id', $comment['postId'])->first();

            if ($post) {
                Comment::updateOrCreate(
                    ['external_id' => $comment['id']],
                    [
                        'post_id' => $post->id,
                        'name' => $comment['name'],
                        'email' => $comment['email'],
                        'body' => $comment['body'],
                    ]
                );
            }
        }
    }
    private function fetchAlbums(): void {
        $this->info('Fetching albums...');

        $albums = Http::withoutVerifying()->get($this->external_api_url . '/albums')->json();

        foreach ($albums as $album) {
            $user = User::where('external_id', $album['userId'])->first();

            if ($user) {
                Album::updateOrCreate(
                    ['external_id' => $album['id']],
                    [
                        'user_id' => $user->id,
                        'title' => $album['title'],
                    ]
                );
            }
        }
    }
    private function fetchPhotos(): void {

        $this->info('Fetching photos...');

        $photos = Http::withoutVerifying()->get($this->external_api_url . '/photos')->json();
        
        foreach ($photos as $photo) {
            $album = Album::where('external_id', $photo['albumId'])->first();

            if ($album) {
                Photo::updateOrCreate(
                    ['external_id' => $photo['id']],
                    [
                        'album_id' => $album->id,
                        'title' => $photo['title'],
                        'url' => $photo['url'],
                        'thumbnail_url' => $photo['thumbnailUrl'],
                    ]
                );
            }
        }
    }
    private function fetchTodos(): void {

        $this->info('Fetching todos...');

        $todos = Http::withoutVerifying()->get($this->external_api_url . '/todos')->json();

        foreach ($todos as $todo) {
            $user = User::where('external_id', $todo['userId'])->first();

            if ($user) {
                Todo::updateOrCreate(
                    ['external_id' => $todo['id']],
                    [
                        'user_id' => $user->id,
                        'title' => $todo['title'],
                        'completed' => $todo['completed'],
                    ]
                );
            }
        }
    }
}