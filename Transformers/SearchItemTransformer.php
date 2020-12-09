<?php


namespace Modules\Isearch\Transformers;


use Illuminate\Http\Resources\Json\JsonResource;

class SearchItemTransformer extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->name ?? $this->title ?? '',
            'slug' => $this->slug ?? '',
            'url' => $this->url ?? '',
            'mainImage' => $this->mediaFiles()->mainimage,
        ];

        return $data;

    }

}
