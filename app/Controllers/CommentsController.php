<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use CodeIgniter\HTTP\ResponseInterface;

class CommentsController extends BaseController
{
    public function index()
    {
        //
    }

    public function getCommentByIssueId($id) {}

    public function addCommentByIssueId($id)
    {
        $session = session();
        $userId = $session->get('user_id');

        $request = service('request');
        $comment = $request->getPost('comment');

        if (!$userId) {
            return redirect()->back()->with('flash', [
                'status'  => false,
                'message' => 'You need to login to comment this issue'
            ]);
        }

        if (is_null($comment)) {
            return redirect()->back()->with('flash', [
                'status'  => false,
                'message' => 'Comment cannot be empty'
            ]);
        }


        // Sanitasi komentar untuk menghindari XSS
        $comment = strip_tags($comment); // Hapus semua tag HTML
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'); // Konversi karakter khusus menjadi entitas HTML
        $comment = trim($comment); // Hapus spasi di awal dan akhir

        date_default_timezone_set('Asia/Jakarta');

        $commentData = [
            'issue_id'   => $id,
            'user_id'    => $userId,
            'comment'    => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => NULL
        ];

        $commentModel = new CommentModel();
        $insertedComment = $commentModel->insert($commentData);

        session()->setFlashdata('flash', [
            'status'  => $insertedComment,
            'message' => $insertedComment ? 'Comment added successfully!' : 'Failed to add comment.'
        ]);

        return redirect()->back();
    }

    public function updateCommentById($id)
    {
        $request = service('request');
        $comment = trim($request->getPost('comment'));

        if (empty($comment)) {
            return redirect()->back()->with('flash', [
                'status'  => false,
                'message' => 'Comment cannot be empty'
            ]);
        }

        $commentModel = new CommentModel();
        $updateStatus = $commentModel->update($id, [
            'comment'    => htmlspecialchars($comment),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('flash', [
            'status'  => $updateStatus,
            'message' => $updateStatus ? 'Comment updated successfully!' : 'Failed to update comment.'
        ]);

        return redirect()->back();
    }

    public function deleteCommentById($id)
    {
        $commentModel = new CommentModel();
        $deleteStatus = $commentModel->delete($id);

        session()->setFlashdata('flash', [
            'status'  => $deleteStatus,
            'message' => $deleteStatus ? 'Comment deleted successfully!' : 'Failed to delete comment.'
        ]);

        return redirect()->back();
    }
}
