<?php

namespace App\Services;

use App\Helpers\StatusReturn;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * @throws Exception
     */
    public function create(array $data): array
    {
        try {
            $user = $this->userRepository->create($data);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        } catch (Exception $e) {
            throw new Exception("Erro ao criar usuário!", StatusReturn::ERROR);
        }
    }

    /**
     * @throws Exception
     */
    public function find(int $id): ?User
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $user;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, int $id): array
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        $this->userRepository->update($user, $data);

        $user = $user->refresh();

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    /**
     * @throws Exception
     */
    public function destroy(int $id): bool
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $this->userRepository->delete($user);
    }
}
