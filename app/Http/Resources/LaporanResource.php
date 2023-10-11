<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'type' => $this->type,
            'jenis' => $this->jenis,
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
            'lokasi' => $this->lokasi,
            'merk' => $this->merk,
            'biaya' => $this->biaya,
            'status' => $this->status,
            'deskripsi' => $this->deskripsi,
            'foto' => $this->foto,
            'foto_perbaikan' => $this->foto_perbaikan,
            'kegiatan_perbaikan' => $this->kegiatan_perbaikan,
            'pihak_terlibat' => $this->pihak_terlibat,
            'created_at' => date_format($this->created_at, 'Y-m-d h:i:s'),
            'user_id' => $this->user_id,
            'username' => $this->username,
        ];
    }
}
