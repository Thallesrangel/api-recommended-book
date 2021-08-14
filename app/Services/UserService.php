<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\http\Requests\UserRequest;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get()
    {
        return $this->userRepository->get();
    }

    public function show($id)
    {
        return $this->userRepository->show($id);
    }

    public function store(UserRequest $request)
    {
        return $this->userRepository->store($request);
    }

    public function destroy($id)
    {
        $response = $this->userRepository->destroy($id);
        
        if ( $response ) {
            return response()->json(['msg' => 'Success'], 200);
        }
    }
}
