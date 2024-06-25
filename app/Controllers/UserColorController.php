<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\ColorRepository;
use App\Repositories\UserColorRepository;
use App\Models\UserColor;


class UserColorController
{
    private $userRepository;
    private $colorRepository;
    private $userColorRepository;

    public function __construct(UserRepository $userRepository, ColorRepository $colorRepository, UserColorRepository $userColorRepository)
    {
        $this->userRepository = $userRepository;
        $this->colorRepository = $colorRepository;
        $this->userColorRepository = $userColorRepository;
    }

    public function addColorsToUser($userId)
    {
        $userColor = new UserColor();

        $colors = new UserColor();
        $userColor->setColorId($_POST['colors'] ?? []);

        $colors = $userColor->getColorId();

        foreach ($colors as $colorId) {
            $this->userColorRepository->addColorsToUser($userId, $colorId);
        }
        header('Location: /users-colors/remove-colors/' . $userId);
        exit();
    }

    public function addColors()
    {
        $userColor = new UserColor();

        $userColor->setUserId($_POST['users']);
        $userColor->setColorId($_POST['colors'] ?? []);

        $userId = $userColor->getUserId();
        $colors = $userColor->getColorId();

        foreach ($colors as $colorId) {
            $this->userColorRepository->addColorsToUser($userId, $colorId);
        }
        header('Location: /users-colors/remove-colors/' . $userId);
        exit();
    }

    public function create()
    {
        $users = $this->userRepository->getAll();
        $colors = $this->colorRepository->getAll();
        $userColors = $this->userColorRepository->getAllUserColors();

        include __DIR__ . '/../Views/user-colors/add-colors.php';
    }

    public function edit($userId)
    {
        $user = $this->userRepository->getById($userId);
        $colors = $this->colorRepository->getAll();
        $userColors = $this->userColorRepository->getAllUserColors();

        include __DIR__ . '/../Views/user-colors/add-colors-to-user.php';
    }

    public function show($userId)
    {
        $user = $this->userRepository->getById($userId);
        $colors = $this->colorRepository->getAllById($userId);
        include __DIR__ . '/../Views/user-colors/remove-colors-to-user.php';
    }

    public function checkLinkUserColor($id)
    {
        $userColor = new UserColor();
        $userColor->setColorId($_POST['colors'] ?? []);
        $color_id = $userColor->getColorId();

        $result = $this->userColorRepository->checkLinkUserColor($id, $color_id);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }

    public function removeColorsToUser($userId, $colorId)
    {
        $this->userColorRepository->removeColorsToUser($userId, $colorId);
        header('Location: /users-colors/remove-colors/' . $userId);
        exit();
    }
}
