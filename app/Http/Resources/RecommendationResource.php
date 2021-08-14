<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecommendationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_indicator' => $this->user_indicator,
            'user_indicated' => $this->user_indicated,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'indicator' => $this->indicator,
            'indicated' => $this->indicated,
        ]; 
    }
}