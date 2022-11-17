<?php

namespace Ggss\Upload\Generator;


use Ggss\Upload\Services\AliVodService;

class Video extends Generator
{
    public $playInfo;
    public function __construct($file, string $disk = null, string $path = null, String $key = null)
    {
        parent::__construct($file, $disk, $path, $key);
        $this->playInfo = AliVodService::getPlayInfo($file);
    }

    public function upload()
    {

        return [
            'video_id' => $this->file,
            'duration' => (int)$this->playInfo['VideoBase']['Duration']
        ];
    }


    public function getDisk()
    {
        return $this->disk ;
    }

    public function getUrl()
    {
        return isset($this->playInfo['PlayInfoList']['PlayInfo'][0]['PlayURL']) ? $this->playInfo['PlayInfoList']['PlayInfo'][0]['PlayURL'] : '';
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getSize()
    {
        return (int)$this->playInfo['PlayInfoList']['Size'];
    }

    public function fileUploadPath()
    {
        return get_class(static::class).'/'.date('m/d',time());
    }

    public function getTempName()
    {
        return (int)$this->playInfo['VideoBase']['Title'];
    }

}
