<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get()
    {
        return $this->user->where('flag_status', "enabled")->get();
    }

    public function show($id)
    {
        try{
            return $this->user->whereId($id)
                                    ->where('flag_status', "enabled")
                                    ->get();
            } catch (\Exception $e){
            throw new ModelNotFoundException('User not found');
        }

        return response()->json(['message' => 'Success'], 200);
    }

    public function store($request) : user
    {
        try {
            return $this->user->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'flag_status' => 'enabled'
            ]); 
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['message' => 'Error processing.']);
        }
    }

    public function update($request, $id)
    {
        try {
            $this->user->whereId($id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]);
            
            return ['success' => true];

        } catch (\Exception $error) {
            throw ValidationException::withMessages(['message' => 'Error.']); 
        }
    }
    
    public function destroy($id)
    {
        try {
            $user = $this->user->whereId($id)->first();
            $user->flag_status = 'disabled';
            $user->save();

         } catch (\Exception $e){
            throw new ModelNotFoundException('User not found');
        }

        return response()->json(['message' => 'Success'], 200); 
    }
}
