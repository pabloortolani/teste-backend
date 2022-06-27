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
    public function create(array $data): User
    {
        try {
            return $this->userRepository->create($data);
        } catch (Exception $e) {
            throw new Exception("Erro ao criar usuário!", StatusReturn::ERROR);
        }
    }

    public function find(int $id): ?User
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $user;
    }

    public function update(array $data, int $id): bool
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $this->userRepository->update($user, $data);
    }

    public function destroy(int $id): bool
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            throw new Exception("Usuário não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $this->userRepository->delete($user);
    }
}
