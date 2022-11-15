<?php

namespace Ggss\upload\Generator;

use Ggss\upload\Exceptions\DatabaseException;
use Ggss\Upload\Models\Media;
use Illuminate\Http\UploadedFile;
abstract class Generator
{
    public $disk;
    public $path;
    public $file;
    public $key;
    public function __construct( $file ,string $disk = null ,string $path = null , String $key = null)
    {
        $this->disk = $disk ?: config('filesystems.default');
        $this->file = $file;
        $this->path = $path ?: $this->fileUploadPath();
        $this->key = $key ?: config('media.mime_default_type');
    }

    public function create()
    {
        $data = $this->upload();
        $model = new Media();
        $model->setRawAttributes($this->getData($data));
        $res = $model->save();
        if(!$res){
            throw new DatabaseException();
        }
        return $model;
    }

    private function getData($data)
    {
        $data['name'] = $this->getTempName();
        $data['conversions_disk'] = $this->getDisk();
        $data['size'] = $this->getSize();
        $data['mime_type'] = $this->key;
        return $data;
    }
    abstract public function upload();

    public function getType()
    {
        return strtolower(class_basename(static::class));
    }


    abstract public function getUrl();
    abstract public function getSize();
    abstract public function getDisk();
    abstract public function getKey();
    abstract public function getTempName();
    abstract public function fileUploadPath();


}
