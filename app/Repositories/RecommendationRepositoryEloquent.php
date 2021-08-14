<?php

namespace App\Repositories;

use App\Models\Recommendation;
use App\Repositories\Contracts\RecommendationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try{
            return $this->recommendation->whereId($id)
                                    ->where('flag_status', "enabled")
                                    ->get();

            } catch (\Exception $e){
            throw new ModelNotFoundException('User not found');
        }

        return response()->json(['message' => 'Success'], 200);                             
    }

    public function store($request) : Recommendation
    {
        try {
            return $this->recommendation->create([
                'user_indicator' => $request->user_indicator,
                'user_indicated' => $request->user_indicated,
                'title' => $request->title,
                'description' => $request->description,
                'flag_status' => 'enabled'
            ]);
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['message' => 'Error processing.']);
        }
    }
    
    public function destroy($id)
    {
        try{
            $recommendation = $this->recommendation->whereId($id)->first();
            $recommendation->flag_status = 'disabled';
            $recommendation->save();

         } catch (\Exception $e){
            throw new ModelNotFoundException('User not found');
        }

        return response()->json(['message' => 'Success'], 200); 
    }
}