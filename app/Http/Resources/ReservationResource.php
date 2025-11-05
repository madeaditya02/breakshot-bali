<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // setLocale(LC_TIME, 'id_ID');
        // Carbon::setLocale('id');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'group' => $this->group,
            'agenda' => $this->agenda,
            'menu_type' => $this->menu_type,
            'count' => $this->count,
            'type' => $this->type,
            'phone' => $this->phone,
            'status' => $this->status,
            'date' => $this->start->locale('id_ID')->isoFormat('D MMMM Y'),
            'hour_start' => $this->start->locale('id_ID')->format('H:i'),
            'hour_end' => $this->end->locale('id_ID')->format('H:i'),
            'plain_date' => $this->start->format('Y-m-d') 
        ];
    }
}
