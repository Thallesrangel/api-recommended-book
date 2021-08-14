<?php

namespace App\Http\Controllers;

use App\http\Requests\UserRequest;
use App\Services\UserService;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

     /**
     * @OA\Get(
     *      path="/api/user",
     *      description="Return all users enabled",
     *      operationId="getAllUser",
     *      tags={"User"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *       ),
     *      @OA\Response(
     *         response=422,
     *         description="Missing Data"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index()
    {
        return UserResource::collection($this->userService->get());
    }

    public function show($id)
    {
        return UserResource::collection($this->userService->show($id));
    }

    /**
     * @OA\Post(
     *     tags={"User"},
     *     path="/api/user",
     *     description="Create new user",
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="First Name",
     *         required=true,
     *          @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Last Name",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(response=201, description="Success."
     *     ),
     *     @OA\Response(response=422, description="Bad Request.")
     * )
    */

    public function store(UserRequest $request)
    {
        return $this->userService->store($request);
    }

    /**
     * @OA\Delete(
     *     tags={"User"},
     *     path="/api/user/{id}",
     *     security={{"bearer_token":{}}},
     *     description="Destroy user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID user",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success."),
     *     @OA\Response(response=401, description="permission denied ."),
     *     @OA\Response(response=404, description="User not found.")
     * ),
    */

    public function update(UserRequest $request, $id)
    {
        return $this->userService->update($request, $id);
    }
    
    public function destroy($id)
    {
        return $this->userService->destroy($id);
    }
}
