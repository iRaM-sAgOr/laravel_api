<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resources;

class Article extends Resources
{
    public function toArray($request)
    {
        
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this -> title,
            'body' => $this->body
        ];
    }
}
