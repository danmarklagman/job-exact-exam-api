<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserAlbum;
use App\Enums\ResourceUrlEnum;
use App\Models\UserAlbumPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ExternalResourceExtractorTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserResourceSeeder extends Seeder
{
    use ExternalResourceExtractorTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = $this->extractUsers();
        $albums = $this->extractAlbums();
        $photos = $this->extractPhotos();
        $role = $this->getNormalUserRole();

        $users->each(function ($user) use ($role, $albums, $photos) {
            if (empty($this->getExistingUserData($user['username']))) {
                $createdUser = User::create([
                    'user_role_id'  => $role,
                    'username'      => strtolower($user['username']),
                    'email'         => strtolower($user['email']),
                    'name'          => $user['name'],
                    'phone'         => $user['phone'],
                    'website'       => $user['website'],
                    'address'       => json_encode($user['address']),
                    'company'       => json_encode($user['company']),
                ]);

                $userAlbums = $albums->where('userId', $user['id'])->all();
                if ($userAlbums) {
                    foreach ($userAlbums as $userAlbum) {
                        $createdUserAlbum = UserAlbum::create([
                            'user_id'   => $createdUser->id,
                            'title'     => $userAlbum['title'],
                        ]);

                        $albumPhotos = $photos->where('albumId', $userAlbum['id'])->all();
                        foreach ($albumPhotos as $albumPhoto) {

                            UserAlbumPhoto::create([
                                'user_album_id' => $createdUserAlbum->id,
                                'title'         => $albumPhoto['title'],
                                'full'          => $albumPhoto['url'],
                                'thumbnail'     => $albumPhoto['thumbnailUrl'],
                                'external'      => true,
                            ]);
                        }
                    }
                }
            }
        }); 
    }

    private function getExistingUserData($username): ?Model
    {
        return User::where('username', $username)->first();
    }

    private function extractUsers(): Collection
    {
        return $this->extract(ResourceUrlEnum::USERS);
    }

    private function extractAlbums(): Collection
    {
        return $this->extract(ResourceUrlEnum::ALBUMS);
    }

    private function extractPhotos(): Collection
    {
        return $this->extract(ResourceUrlEnum::PHOTOS);
    }

    private function getNormalUserRole(): string
    {
        $role = UserRole::where('name', 'normal')->first();

        return $role->id;
    }
}
