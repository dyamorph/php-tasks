<?php

declare(strict_types=1);

namespace app\providers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="gorest rest api"
 * )
 * @OA\Server(
 *     url="https://gorest.co.in/public/v2",
 * )
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="gender", type="string"),
 *     @OA\Property(property="status", type="string"),
 * )
 * @OA\SecurityScheme(
 *   securityScheme="token",
 *   type="apiKey",
 *   name="Authorization",
 *   in="header"
 * )
 */
class UserApiProvider extends ApiProvider
{
    public function __construct()
    {
        parent::__construct(
            "https://gorest.co.in/public/v2/users",
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Bearer 91c0714d833bc0830a709ccdbf6135d7b515a8de33e2f30db58bdc18fdcc5426"
            ]
        );
    }

    /**
     * Get a single user by ID
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Get a single user",
     *     tags={"Users"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User data",
     *         @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authorization error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     )
     *
     * )
     */
    public function first(string $id): array | string
    {
        return $this->apiClient->get($id);
    }

    /**
     * Get all users
     *
     * @OA\Get(
     *     path="/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="List of users",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function all(): array | string
    {
        return $this->apiClient->get();
    }

    /**
     * Get users with pagination
     *
     * @OA\Get(
     *     path="/users",
     *     summary="Get users with pagination",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         description="Page number",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=true,
     *         description="Users per page",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of users with pagination",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function withLimit(int $page, int $limit): array | string
    {
        return $this->apiClient->get(null, $page, $limit);
    }

    /**
     * Create new user
     *
     * @OA\Post(
     *     path="/users",
     *     summary="Create new user",
     *     tags={"Users"},
     *     security={{"token": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="gender", type="string"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authorization error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     )
     * )
     */
    public function create(array $data): string | bool
    {
        return $this->apiClient->set($data);
    }

    /**
     * Update a user by ID
     *
     * @OA\Patch(
     *     path="/users/{id}",
     *     summary="Update a user",
     *     tags={"Users"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated user data",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="gender", type="string"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     )
     * )
     */
    public function update(array $data, string $id): string | bool
    {
        return $this->apiClient->update($data, $id);
    }

    /**
     * Delete a user by ID
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Delete a user",
     *     tags={"Users"},
     *     security={{"token": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="User deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         ),
     *     )
     * )
     */
    public function delete(string $id): string | bool
    {
        return $this->apiClient->delete($id);
    }
}
