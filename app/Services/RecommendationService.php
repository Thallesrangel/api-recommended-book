<?php

namespace App\Services;

use App\Repositories\Contracts\RecommendationRepositoryInterface;
use App\http\Requests\RecommendationRequest;

class RecommendationService
{
    protected $recommendationRepository;

    public function __construct(RecommendationRepositoryInterface $recommendationRepository)
    {
        $this->recommendationRepository = $recommendationRepository;
    }

    public function get()
    {
        return $this->recommendationRepository->get();
    }

    public function show($id)
    {
        return $this->recommendationRepository->show($id);
    }

    public function store(RecommendationRequest $request)
    {
        return $this->recommendationRepository->store($request);
    }

    public function destroy($id)
    {
        $response = $this->recommendationRepository->destroy($id);
        
        if ( $response ) {
            return response()->json(['msg' => 'Success'], 200);
        }
    }
}
