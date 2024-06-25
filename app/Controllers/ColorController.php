<?php

namespace App\Controllers;

use App\Repositories\ColorRepository;
use App\Models\Color;

class ColorController
{

    private $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function index()
    {
        $colors = $this->colorRepository->getAll();
        include __DIR__ . '/../Views/colors/list-color.php';
    }

    public function show($id)
    {
        $color = $this->colorRepository->getById($id);
        include __DIR__ . '/../Views/colors/show-color.php';
    }

    public function create()
    {
        include __DIR__ . '/../Views/colors/create-color.php';
    }

    public function store()
    {
        $color = new Color();
        $color->setName($_POST['name']);
        $this->colorRepository->create($color);
        header('Location: /colors');
    }

    public function edit($id)
    {
        $color = $this->colorRepository->getById($id);
        include __DIR__ . '/../Views/colors/edit-color.php';
    }

    public function update($id)
    {
        $color = $this->colorRepository->getById($id);
        $color->setName($_POST['name']);
        $this->colorRepository->update($color);
        header('Location: /colors');
    }

    public function delete($id)
    {
        $this->colorRepository->delete($id);
        header('Location: /colors');
    }

    public function checkColor()
    {
        $name = $_POST['name'];
        $result = $this->colorRepository->checkColor($name);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }

    public function checkUpdateColor($id)
    {
        $name = $_POST['name'];
        $result = $this->colorRepository->checkUpdateColor($id, $name);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }

    public function checkDeleteColor($id)
    {
        $result = $this->colorRepository->checkDeleteColor($id);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $result]);
        exit;
    }
}
