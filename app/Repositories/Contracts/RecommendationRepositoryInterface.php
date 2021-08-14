<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\RecommendationRequest;

interface RecommendationRepositoryInterface
{
    public function get();
    public function show($id);
    public function store(RecommendationRequest $request);
    public function update(RecommendationRequest $request, $id);
    public function destroy($id);
}