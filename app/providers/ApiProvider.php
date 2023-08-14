<?php

namespace app\providers;

use app\core\CurlClient;
use app\interfaces\IDataProvider;
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
class ApiProvider implements IDataProvider
{
    private string $baseUrl;
    private array $headers;
    private CurlClient $curl;

    public function __construct($baseUrl, $headers)
    {
        $this->headers = $headers;
        $this->baseUrl = $baseUrl;
        $this->curl = new CurlClient();
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
        $url = $this->baseUrl . "/$id";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->close();

        return json_decode($this->curl->execute(), true, 512, JSON_THROW_ON_ERROR);
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
        $url = $this->baseUrl;

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->close();

        return json_decode($this->curl->execute(), true, 512, JSON_THROW_ON_ERROR);
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
        $url = $this->baseUrl . "?page=$page&per_page=$limit";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->close();

        return json_decode($this->curl->execute(), true, 512, JSON_THROW_ON_ERROR);
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
        $url = $this->baseUrl;

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS    => json_encode($data, JSON_THROW_ON_ERROR)
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
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
        $url = $this->baseUrl . "/$id";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "PATCH",
                CURLOPT_POSTFIELDS    => json_encode($data, JSON_THROW_ON_ERROR)
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
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
        $url = $this->baseUrl . "/$id";

        $this->curl->setUrl($url);
        $this->curl->setHeaders($this->headers);
        $this->curl->setOptions(
            [
                CURLOPT_CUSTOMREQUEST => "DELETE",
            ]
        );
        $this->curl->close();

        return $this->curl->execute();
    }
}
