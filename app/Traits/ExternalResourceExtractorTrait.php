<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

trait ExternalResourceExtractorTrait {

    public function extract($resourceUrl): Collection
    {
        $response = Http::get($resourceUrl);

        if ($response->ok()) {
            return $response->collect();
        }

        return collect([]);
    }
}
