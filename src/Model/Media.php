<?php

namespace Ggss\Upload\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    public function MediaRelation()
    {
        return $this->hasOne(MediaRelation::class, 'media_id', 'id');
    }
}
