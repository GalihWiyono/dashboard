<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\IssueModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('pages/dashboard');
    }

    public function getChart()
    {
        $userModel = new UserModel();
        $issueModel = new IssueModel();
        $commentModel = new CommentModel();

        $data = [
            'users' => $userModel->getUserCount(),
            'issues' => $issueModel->getIssueCount(),
            'comments' => $commentModel->getCommentCount()
        ];

        return $this->response->setJSON($data);
    }
}
