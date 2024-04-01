<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomentarModel;
use App\Models\LikeModel;
use CodeIgniter\HTTP\ResponseInterface;

class LikeKomen extends BaseController
{
    protected $M_like;
    protected $M_komentar;

    public function __construct()
    {
        $this->M_like = new LikeModel();
        $this->M_komentar = new KomentarModel();
    }

    public function index()
    {
        return redirect()->to('/');
    }

    public function like()
    {
        $d = $this->request->getVar();
        $fotoid = $d['foto_id'];
        $like = $this->M_like->where(['foto_id' => $fotoid, 'user_id' => $d['user_id']])->first();

        if ($like) {
            $this->M_like->delete($like['id']);
        } else {
            $this->M_like->insert($d);
        }
        return redirect()->to('photos/detail/' . $fotoid);
    }

    public function addkomen($fotoid)
    {
        $this->isLogedIn();

        $d = $this->request->getVar();
        $d['user_id'] = session()->get('user_id');
        $d['foto_id'] = $fotoid;

        $this->M_komentar->insert($d);

        return redirect()->to('photos/detail/' . $fotoid);
    }

    public function deletekomen()
    {
        $this->isLogedIn();
        $d = $this->request->getVar();
        $komen = $this->M_komentar->where(['id' => $d['id']])->first();

        if ($komen['user_id'] != session()->get('user_id')) {
            $data = [
                'error' => 'Anda tidak mempunyai akses',
            ];
            session()->setFlashdata($data);
            return redirect()->to('photos/detail/' . $d['foto_id']);
        }

        $this->M_komentar->delete($d['id']);
        return redirect()->to('photos/detail/' . $d['foto_id']);
    }
}
