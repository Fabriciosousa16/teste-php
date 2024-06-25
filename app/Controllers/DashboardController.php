<?php

namespace App\Controllers;

use App\Repositories\DashboardRepository;

class DashboardController
{

    private $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {

        $totalUsers = $this->dashboardRepository->getTotalUsers();
        $totalColors = $this->dashboardRepository->getTotalColors();
        $totalUsersWithColors = $this->dashboardRepository->getTotalUsersWithColors();
        $userColorRanking = $this->dashboardRepository->getUserColorRanking();
        $userNotColorRanking = $this->dashboardRepository->getUserNotColorRanking();

        require_once __DIR__ . '/../views/dashboard/dashboard.php';
    }
}
