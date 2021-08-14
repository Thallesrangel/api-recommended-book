<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\UserRequest;

interface UserRepositoryInterface
{
    public function get();
    public function show($id);
    public function store(UserRequest $request);
    public function update(UserRequest $request, $id);
    public function destroy($id);
}