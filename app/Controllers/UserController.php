<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;

class UserController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        include __DIR__ . '/../Views/users/list-user.php';
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        include __DIR__ . '/../Views/users/show-user.php';
    }

    public function create()
    {
        include __DIR__ . '/../Views/users/create-user.php';
    }

    public function store()
    {
        $user = new User();
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $this->userRepository->create($user);
        header('Location: /users');
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        include __DIR__ . '/../Views/users/edit-user.php';
    }

    public function update($id)
    {
        $user = $this->userRepository->getById($id);
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $this->userRepository->update($user);
        header('Location: /users');
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);
        header('Location: /users');
    }

    public function checkEmail()
    {
        $email = $_POST['email'];
        $result = $this->userRepository->checkEmail($email);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }

    public function checkUpdateUser($id)
    {
        $email = $_POST['email'];
        $result = $this->userRepository->checkUpdateUser($id, $email);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }

    public function checkDeleteUser($id)
    {
        $result = $this->userRepository->checkDeleteUser($id);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }
}
