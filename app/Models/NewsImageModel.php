<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsImageModel extends Model
{
    protected $table            = 'news_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['news_id', 'image_path', 'is_main', 'created_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getImagesByNewsId($news_id)
    {
        return $this->where('news_id', $news_id)->orderBy('is_main', 'DESC')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getMainImage($news_id)
    {
        return $this->where('news_id', $news_id)->where('is_main', 1)->first();
    }

    public function setMainImage($news_id, $image_id)
    {
        // Set all to 0
        $this->where('news_id', $news_id)->set(['is_main' => 0])->update();
        // Set selected to 1
        return $this->update($image_id, ['is_main' => 1]);
    }
}
