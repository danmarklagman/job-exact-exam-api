<?php

namespace App\Http\Controllers\Album;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Album\AlbumResource;
use App\Services\Album\GetAlbumByParameterService;

class FindAlbumController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        Request $request,
        GetAlbumByParameterService $getAlbumByParameterService,
        string $id
    )
    {
        try {

            $getAlbumByParameterService->parameter = [
                'column'    => 'id',
                'value'     => $id,
            ];
            $user = $getAlbumByParameterService->run();

            return new AlbumResource($user);
        }
        catch (Exception $e) {

            return $this->error(
                $e->getMessage(),
                $request->all()
            );
        }
    }
}
