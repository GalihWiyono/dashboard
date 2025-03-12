<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IssueModel;
use CodeIgniter\HTTP\ResponseInterface;

class IssuesController extends BaseController
{
    public function index()
    {
        $issueModel = new IssueModel();
        $search = $this->request->getGet('search'); // Ambil nilai pencarian dari GET
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id'); // Ambil user_id dari session

        $query = $issueModel->select('issues.*, users.name as name')
            ->join('users', 'users.id = issues.user_id');

        // Jika bukan admin, filter berdasarkan user_id
        if ($role !== 'admin') {
            $query->where('issues.user_id', $userId);
        }

        // Jika ada pencarian, tambahkan filter
        if (!empty($search)) {
            $query->groupStart()
                ->like('title', $search)
                ->orLike('message', $search)
                ->orLike('name', $search)
                ->groupEnd();
        }

        $data = [
            'issues' => $query->paginate(5, 'users'),
            'pager' => $issueModel->pager,
            'search' => $search // Kirim kembali nilai search agar tetap di input
        ];

        return view('pages/issue/issues', $data);
    }

    public function getIssue($id)
    {
        $issueModel = new IssueModel();

        // Cek role user
        $userRole = session()->get('role');

        if ($userRole === 'admin') {
            // Jika admin, join dengan tabel users untuk mendapatkan nama user
            $issue = $issueModel->select('issues.*, users.name as username')
                ->join('users', 'users.id = issues.user_id', 'left')
                ->where('issues.id', $id)
                ->first();
        } else {
            // Jika bukan admin, hanya ambil data issue saja
            $issue = $issueModel->where('id', $id)->first();
        }

        // Jika data tidak ditemukan
        if (!$issue) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Issue not found'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Issue retrieved successfully',
            'data'    => $issue
        ]);
    }

    public function showAddIssue()
    {
        return view('pages/issue/add_issue');
    }

    public function saveIssue()
    {
        $request = service('request');
        $issueModel = new IssueModel();
        $session = session();
        $userId = $session->get('user_id');

        if (!$this->validate([
            'title'    => 'required',
            'message'  => 'required',
            'issue'    => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photo'    => 'is_image[photo]|max_size[photo,2048]',
            'video'    => 'mime_in[video,video/mp4,video/avi,video/mov]|max_size[video,10240]',
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('flash', [
                'status'  => false,
                'message' => implode('<br>', $validation->getErrors()) // Gabungkan semua error dalam satu pesan
            ]);

            return redirect()->to('/issue/create')->withInput();
        }


        $photo = $this->request->getFile('photo');
        $photoName = $photo && $photo->isValid() ? $photo->getRandomName() : null;
        $photoPath = null;

        if ($photoName) {
            $photo->move(FCPATH . 'uploads/photos/', $photoName);
            $photoPath = base_url('uploads/photos/' . $photoName);
        }

        $video = $this->request->getFile('video');
        $videoName = $video && $video->isValid() ? $video->getRandomName() : null;
        $videoPath = null;

        if ($videoName) {
            $video->move(FCPATH . 'uploads/videos/', $videoName);
            $videoPath = base_url('uploads/videos/' . $videoName);
        }


        $addIssueStatus = $issueModel->insert([
            'title'    => $request->getPost('title'),
            'message'  => $request->getPost('message'),
            'issue'    => $request->getPost('issue'),
            'latitude' => $request->getPost('latitude'),
            'longitude' => $request->getPost('longitude'),
            'path_photo' => $photoPath,
            'path_video' => $videoPath,
            'user_id'  => $userId
        ]);

        session()->setFlashdata('flash', [
            'status'  => $addIssueStatus,
            'message' =>  $addIssueStatus ? 'Issue added successfully!' : 'Failed to add issue.'
        ]);

        return redirect()->to('/issue/create');
    }

    public function showDetailIssue($id)
    {

        $issueModel = new IssueModel();

        // Cek role user
        $userRole = session()->get('role');

        if ($userRole === 'admin') {
            // Jika admin, join dengan tabel users untuk mendapatkan nama user
            $issue = $issueModel->select('issues.*, users.name as username')
                ->join('users', 'users.id = issues.user_id', 'left')
                ->where('issues.id', $id)
                ->first();
        } else {
            // Jika bukan admin, hanya ambil data issue saja
            $issue = $issueModel->where('id', $id)->first();
        }

        // Jika data tidak ditemukan
        if (!$issue) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $comments = [
            ['name' => 'John Doe', 'message' => 'Komentar pertama!', 'created_at' => '2024-03-11 14:30:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:35:00'],
            ['name' => 'Jane Smith', 'message' => 'Halo semuanya!', 'created_at' => '2024-03-11 14:37:00'],
        ];
    
        return view('pages/issue/detail_issue', ['issue' => $issue, 'comments' => $comments]);
    }

    public function showEditIssue($id)
    {

        $issueModel = new IssueModel();

        // Cek role user
        $userRole = session()->get('role');

        if ($userRole === 'Admin') {
            // Jika admin, join dengan tabel users untuk mendapatkan nama user
            $issue = $issueModel->select('issues.*, users.name as username')
                ->join('users', 'users.id = issues.user_id', 'left')
                ->where('issues.id', $id)
                ->first();
        } else {
            // Jika bukan admin, hanya ambil data issue saja
            $issue = $issueModel->where('id', $id)->first();
        }

        // Jika data tidak ditemukan
        if (!$issue) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pages/issue/edit_issue', ['issue' => $issue]);
    }

    public function saveEditIssue($id)
    {
        $request = service('request');
        $issueModel = new IssueModel();

        // Ambil data lama
        $issue = $issueModel->find($id);
        if (!$issue) {
            session()->setFlashdata('flash', ['status' => false, 'message' => 'Issue not found.']);
            return redirect()->to('/issue');
        }

        // Validasi Input
        if (!$this->validate([
            'title'    => 'required',
            'message'  => 'required',
            'issue'    => 'required',
            'photo'    => 'permit_empty|is_image[photo]|max_size[photo,2048]',
            'video'    => 'permit_empty|mime_in[video,video/mp4,video/avi,video/mov]|max_size[video,10240]',
        ])) {
            session()->setFlashdata('flash', [
                'status'  => false,
                'message' => implode('<br>', \Config\Services::validation()->getErrors())
            ]);
            return redirect()->to('/issue/edit/' . $id)->withInput();
        }

        // Upload Foto
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid()) {
            $photoName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads/photos/', $photoName);
            $photoPath = base_url('uploads/photos/' . $photoName);
        } else {
            $photoPath = $issue['path_photo'];
        }

        // Upload Video
        $video = $this->request->getFile('video');
        if ($video && $video->isValid()) {
            $videoName = $video->getRandomName();
            $video->move(FCPATH . 'uploads/videos/', $videoName);
            $videoPath = base_url('uploads/videos/' . $videoName);
        } else {
            $videoPath = $issue['path_video'];
        }

        // Update Data
        $updateIssueStatus = $issueModel->update($id, [
            'title'     => $request->getPost('title'),
            'message'   => $request->getPost('message'),
            'issue'     => $request->getPost('issue'),
            'path_photo' => $photoPath,
            'path_video' => $videoPath
        ]);

        // Set Flash Message
        session()->setFlashdata('flash', [
            'status'  => $updateIssueStatus,
            'message' => $updateIssueStatus ? 'Issue updated successfully!' : 'Failed to update issue.'
        ]);

        return redirect()->to('/issue/edit/' . $id);
    }
}
