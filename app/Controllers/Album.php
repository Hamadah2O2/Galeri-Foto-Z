<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\FotoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Album extends BaseController
{
    protected $M_album;
    protected $M_foto;

    public function __construct()
    {
        $this->M_album = new AlbumModel();
        $this->M_foto = new FotoModel();
    }

    public function index()
    {
        $album = $this->M_album->where(['user_id' => session()->get('user_id')])->findAll();

        $data = [
            'title' => 'My Album',
            'album' => $album
        ];
        return view('album/index', $data);
    }

    public function detail($id)
    {
        $photos = $this->M_foto->select(['foto.*', 'users.username'])
            ->join('users', 'foto.user_id = users.id')
            ->where(['album_id' => $id])
            ->findAll();
        $album = $this->M_album->where(['id' => $id])->first();
        $data = [
            'title' => 'Galeri Foto',
            'bigTitle' => 'Detail Album',
            'album' => $album,
            'photos' => $photos,
        ];
        return view('album/detail', $data);
    }

    public function create()
    {
        $this->isLogedIn();

        $data = [
            'title' => 'Create Album',
        ];
        return view('album/create', $data);
    }

    public function aksi_create()
    {
        $d = $this->request->getVar();
        $d['user_id'] = session()->get('user_id');

        $this->M_album->insert($d);

        $data = [
            'success' => 'Berhasi Tambah Album',
        ];
        session()->setFlashdata($data);
        return redirect()->to('album');
    }

    public function edit($id)
    {
        $this->isLogedIn();
        $album = $this->M_album->where(['id' => $id, 'user_id' => session()->get('user_id')])->first();

        $data = [
            'title' => 'Edit Album',
            'album' => $album
        ];
        return view('album/edit', $data);
    }

    public function aksi_edit()
    {
        $this->isLogedIn();

        $d = $this->request->getVar();
        d($d);

        $this->M_album->update($d['id'], $d);

        $data = [
            'success' => 'Berhasi Edit Album',
        ];
        session()->setFlashdata($data);
        return redirect()->to('album');
    }

    public function delete($id)
    {
        $this->isLogedIn();
        $album = $this->M_album->where(['id' => $id])->first();

        if ($album['user_id'] != session()->get('user_id')) {
            $data = [
                'error' => 'Anda tidak mempunyai akses',
            ];
            session()->setFlashdata($data);
            return redirect()->to('album');
        }

        $this->M_album->delete($id);

        $data = [
            'success' => 'Berhasi Hapus Album',
        ];
        session()->setFlashdata($data);
        return redirect()->to('album');
    }
}
