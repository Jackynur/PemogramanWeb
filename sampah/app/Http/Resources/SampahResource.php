<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SampahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'berat' => $this->berat_formatted,
            'kategori' => new KategoriResource($this->kategori),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
