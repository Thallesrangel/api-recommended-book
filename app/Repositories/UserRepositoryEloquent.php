<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
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
        return $this->user->whereId($id)->get();
    }

    public function store($request) : user
    {
        return $this->user->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'flag_status' => 'enabled'
        ]);
    }

    public function update($request, $id)
    {
        try {
            $user = $this->user->whereId($id)->update([
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
        $user = $this->user->whereId($id)->first();

        if (!$user) {
            throw ValidationException::withMessages(['message' => 'User not found.']);
        }

        return $user->update([
           'flag_status' => "disabled"
        ]);
    }
}
