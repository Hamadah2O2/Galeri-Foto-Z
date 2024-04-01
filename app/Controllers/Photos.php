<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\FotoModel;
use App\Models\KomentarModel;
use App\Models\LikeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Photos extends BaseController
{
    protected $M_foto;
    protected $M_album;
    protected $M_komen;
    protected $M_like;

    public function __construct()
    {
        $this->M_foto = new FotoModel();
        $this->M_album = new AlbumModel();
        $this->M_komen = new KomentarModel();
        $this->M_like = new LikeModel();
    }

    public function index()
    {
        $like = $this->M_like;
        $komen = $this->M_komen;
        $photos = $this->M_foto->select(['foto.*', 'users.username'])->join('users', 'foto.user_id = users.id')->orderBy('RAND()')->findAll();
        $data = [
            'title' => 'Galeri Foto',
            'photos' => $photos,
            'like' => $like,
            'komen' => $komen
        ];
        return view('index', $data);
    }

    public function myphotos()
    {
        $this->isLogedIn();

        $like = $this->M_like;
        $komen = $this->M_komen;

        $photos = $this->M_foto->select(['foto.*', 'users.username'])
            ->join('users', 'foto.user_id = users.id')
            ->where(['user_id' => session()->get('user_id')])
            ->findAll();

        $data = [
            'title' => 'Galeri Foto',
            'bigTitle' => 'My Photos',
            'photos' => $photos,
            'like' => $like,
            'komen' => $komen
        ];
        return view('index', $data);
    }

    public function detail($id)
    {
        $photo = $this->M_foto->select(['foto.*', 'users.username', 'album.nama as album_name'])
            ->join('users', 'users.id = foto.user_id', 'left')
            ->join('album', 'album.id = foto.album_id', 'left')
            ->where(['foto.id' => $id])->first();
        $komentar = $this->M_komen
            ->select(['komentar_foto.*', 'users.username'])
            ->join('users', 'komentar_foto.user_id = users.id')
            ->where(['foto_id' => $id])
            ->orderBy('tanggal', 'desc')
            ->findAll();
        $like = $this->M_like
            ->where(['foto_id' => $id])
            ->findAll();
        $isLiked = $this->M_like
            ->where(['foto_id' => $id, 'user_id' => session()->get('user_id')])
            ->first();

        $data = [
            'title' => 'Galeri Foto',
            'bigTitle' => 'Detail Album',
            'photo' => $photo,
            'komentar' => $komentar,
            'like' => $like,
            'isLiked' => $isLiked
        ];
        return view('photos/detail', $data);
    }

    public function create()
    {
        $this->isLogedIn();

        $album = $this->M_album->where(['user_id' => session()->get('user_id')])->findAll();
        $data = [
            'title' => 'Tambah Foto',
            'album' => $album
        ];
        return view('photos/create', $data);
    }

    public function aksi_create()
    {
        $this->isLogedIn();

        $d = $this->request->getVar();
        $file = $this->request->getFile('gambar');
        $d['lokasi_file'] = $file->getRandomName();
        $d['user_id'] = session()->get('user_id');
        $d['album_id'] = (empty($d['album_id'])) ? NULL : $d['album_id'];

        $this->M_foto->insert($d);
        $file->move('assets/img', $d['lokasi_file']);

        $data = [
            'success' => 'Berhasil tambah Gambar',
        ];
        session()->setFlashdata($data);
        return redirect()->to('/');
    }

    public function edit($id)
    {
        $this->isLogedIn();

        $photo = $this->M_foto->where(['id' => $id])->first();
        $album = $this->M_album->where(['user_id' => session()->get('user_id')])->findAll();

        if ($photo['user_id'] != session()->get('user_id')) {
            $data = [
                'error' => 'Anda tidak mempunyai akses',
            ];
            session()->setFlashdata($data);
            return redirect()->to('photos/myphotos');
        }

        $data = [
            'title' => 'Tambah Foto',
            'photo' => $photo,
            'album' => $album
        ];
        return view('photos/edit', $data);
    }


    public function aksi_edit()
    {
        $this->isLogedIn();

        $d = $this->request->getVar();
        $photo = $this->M_foto->where(['id' => $d['id']])->first();
        $file = $this->request->getFile('gambar');
        $d['album_id'] = (empty($d['album_id'])) ? NULL : $d['album_id'];

        if ($file->getName() != "") {
            $path = "assets/img/" . $photo['lokasi_file'];
            unlink($path);
            $d['lokasi_file'] = $file->getRandomName();
            $file->move('assets/img', $d['lokasi_file']);
        }

        $this->M_foto->update($d['id'], $d);

        $data = [
            'success' => 'Berhasil edit Gambar',
        ];
        session()->setFlashdata($data);
        return redirect()->to('photos/myphotos');
        dd($d);
    }

    public function delete($id)
    {
        $this->isLogedIn();

        $photo = $this->M_foto->select(['foto.*', 'users.username', 'album.nama as album_name'])
            ->join('users', 'users.id = foto.user_id', 'left')
            ->join('album', 'album.id = foto.album_id', 'left')
            ->where(['foto.id' => $id])->first();

        if ($photo['user_id'] != session()->get('user_id')) {
            $data = [
                'error' => 'Anda tidak mempunyai akses',
            ];
            session()->setFlashdata($data);
            return redirect()->to('photos/myphotos');
        }

        if (is_file('./assets/img/'.$photo['lokasi_file'])) {
            unlink('./assets/img/'.$photo['lokasi_file']);
        }

        $this->M_foto->delete($id);
        $data = [
            'success' => 'Foto berhasil dihapus',
        ];
        session()->setFlashdata($data);
        return redirect()->to('photos/myphotos');
    }
}
