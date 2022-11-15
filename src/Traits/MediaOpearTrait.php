<?php


namespace Ggss\Upload\Traits;
use Closure;

trait MediaOpearTrait
{

    public function upload($file ,Closure $callback)
    {
        if(is_array($file) ){
            for($i=0; $i< count($file); $i++){
                $model[] = $callback($file[$i]);
            }
            return $model;
        }
        return $callback($file);
    }

}
