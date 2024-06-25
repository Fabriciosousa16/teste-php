<?php

namespace App\Controllers;

use App\Repositories\ReportRepository;

class ReportController
{
    private $reportsRepository;

    public function __construct(ReportRepository $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
    }

    public function index()
    {
        $users = $this->reportsRepository->getUsers();
        $colors = $this->reportsRepository->getColors();

        require_once __DIR__ . '/../views/reports/reports.php';
    }

    public function filter()
    {
        $userId = $_POST['user_id'];
        $colorId = $_POST['color_id'];

        $results = $this->reportsRepository->getFilteredResults($userId, $colorId);

        echo json_encode($results);
    }
}
