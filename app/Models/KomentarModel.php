<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table            = 'komentar_foto';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'isi_komentar', 'foto_id', 'user_id'
    ];

    public function getJumKomen($fotoid)
    {
        $like = $this->where(['foto_id' => $fotoid])->findAll();
        return count($like);
    }
}
