<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $search = $this->request->getGet('search'); // Ambil nilai pencarian dari GET

        $query = $userModel->where('approval_status', 'approved')->where('role', 'User');

        // Jika ada pencarian, tambahkan filter
        if (!empty($search)) {
            $query->groupStart()
                ->like('name', $search)
                ->orLike('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $data = [
            'users' => $query->paginate(5, 'users'),
            'pager' => $userModel->pager,
            'search' => $search // Kirim kembali nilai search agar tetap di input
        ];

        return view('pages/user/users', $data);
    }


    public function pendingUsers()
    {
        $userModel = new UserModel();
        $search = $this->request->getGet('search'); // Ambil nilai pencarian dari GET

        $query = $userModel->where('approval_status', 'pending')->where('role', 'User');

        // Jika ada pencarian, tambahkan filter
        if (!empty($search)) {
            $query->groupStart()
                ->like('name', $search)
                ->orLike('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $data = [
            'users' => $query->paginate(5, 'users'),
            'pager' => $userModel->pager,
            'search' => $search // Kirim kembali nilai search agar tetap di input
        ];

        return view('pages/user/pending_users', $data);
    }

    public function getUserById($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            return $this->response->setJSON($user);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan'], 404);
        }
    }

    public function updateUser($id)
    {
        $data = [
            'name'     => esc($this->request->getPost('name'), 'html'),
            'email'    => filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL),
            'username' => esc($this->request->getPost('username'), 'html')
        ];

        $userModel = new UserModel();
        $update = $userModel->update($id, $data);

        session()->setFlashdata('flash', [
            'status'  => $update,
            'message' => $update ? 'Data updated successfully!' : 'Failed to update data.'
        ]);

        return redirect()->to(base_url('/users'));
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();

        $status = $userModel->delete($id);

        session()->setFlashdata('flash', [
            'status'  => $status,
            'message' => $status ? 'User deleted successfully.' : 'Failed to delete user.'
        ]);

        return redirect()->to(base_url('/users'));
    }

    public function approveUser($id)
    {
        $userModel = new UserModel();

        $status = $userModel->update($id, ['approval_status' => 'approved']);

        session()->setFlashdata('flash',[
            'status'  => $status,
            'message' => $status ? 'User approved successfully.' : 'Failed to approve user.'
        ]);

        return redirect()->to(base_url('users/pending'));
    }

    public function rejectUser($id) {
        $userModel = new UserModel();

        $status = $userModel->update($id, ['approval_status' => 'rejected']);

        session()->setFlashdata('flash',[
            'status'  => $status,
            'message' => $status ? 'User rejected successfully.' : 'Failed to reject user.'
        ]);

        return redirect()->to(base_url('users/pending'));
    }
}
