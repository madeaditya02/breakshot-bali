<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeeklyEventResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'day_number' =>$this->weekly_day,
            'day' => now()->startOfWeek()->addDays($this->weekly_day-1)->locale('id_ID')->isoFormat('dddd'),
            'time_english' => now()->startOfWeek()->addDays($this->weekly_day-1)->isoFormat('dddd') . ", " . now()->startOfDay()->setTimeFromTimeString($this->weekly_hour)->isoFormat('h:mm A'),
            'hour' => Str::of($this->weekly_hour)->explode(':')->slice(0,2)->implode(':'),
            'description' => Str::words($this->description, 12, '....'),
            'description_full' => $this->description,
            'show' => $this->show,
        ];
    }
}
