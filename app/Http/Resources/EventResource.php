<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->start->locale('id_ID')->isoFormat('D MMMM Y'),
            'date_english' => $this->start->isoFormat('MMMM D, Y'),
            'date_raw' => $this->start->format('Y-m-d'),
            'name' => $this->name,
            'start_time' => $this->start->format('h:i'),
            'end_time' => $this->end->format('h:i'),
            'description' => Str::words($this->description, 6, '....'),
            'description_full' => $this->description,
            'organizer' => $this->organizer,
            'show' => $this->show,
            'image' => $this->image,
        ];
    }
}
