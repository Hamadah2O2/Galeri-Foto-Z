<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table            = 'like_foto';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'foto_id', 'tanggal_like'
    ];

    public function getJumLike($fotoid){
        $like = $this->where(['foto_id' => $fotoid])->findAll();
        return count($like);
    }
}
