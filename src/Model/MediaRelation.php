<?php

namespace Ggss\Upload\Models;

use Illuminate\Database\Eloquent\Model;

class MediaRelation extends Model
{
    protected $table = 'media_relation';

    public function Media()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }
}
