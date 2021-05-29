<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Masjid extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'nama_masjid' => $this->nama_masjid,
          'latitude_masjid' => $this->latitude_masjid,
          'longitude_masjid' => $this->longitude_masjid,
          'created_at' => $this->created_at->format('m/d/Y'),
          'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
