<?php

namespace Ggss\Upload\Generator;


class Image extends Generator
{

    public function upload()
    {
        $path = \Storage::disk($this->disk)->putFile($this->path, $this->file->getRealPath());
        return [
            'path' => $path
        ];
    }


    public function getDisk()
    {
        return $this->disk ;
    }

    public function getUrl()
    {
        return \Storage::disk($this->disk)->url();
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getSize()
    {
        return $this->file->getSize();
    }

    public function fileUploadPath()
    {
        return get_class(static::class).'/'.date('m/d',time());
    }

    public function getTempName()
    {
        return $this->file->getFileName();
    }
}
