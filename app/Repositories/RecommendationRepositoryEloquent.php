<?php

namespace App\Repositories;

use App\Models\Recommendation;
use App\Repositories\Contracts\RecommendationRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RecommendationRepositoryEloquent implements RecommendationRepositoryInterface
{
    protected $recommendation;

    public function __construct(Recommendation $recommendation)
    {
        $this->recommendation = $recommendation;
    }

    public function get()
    {
        return $this->recommendation->with('indicator')
                                    ->with('indicated')
                                    ->where('flag_status', "enabled")
                                    ->get();
    }

    public function show($id)
    {
        return $this->recommendation->whereId($id)
                                    ->where('flag_status', "enabled")
                                    ->get();
    }

    public function store($request) : Recommendation
    {
        return $this->recommendation->create([
            'user_indicator' => $request->user_indicator,
            'user_indicated' => $request->user_indicated,
            'title' => $request->title,
            'description' => $request->description,
            'flag_status' => 'enabled'
        ]);
    }
    
    public function destroy($id)
    {
        $recommendation = $this->recommendation->whereId($id)->first();

        if (!$recommendation) {
            throw ValidationException::withMessages(['message' => 'Recommendation not found.']);
        }

        return $recommendation->update([
           'flag_status' => "disabled"
        ]);
    }
}
