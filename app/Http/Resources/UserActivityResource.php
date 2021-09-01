<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $qn=[];
        return [
            'user_sub_activity1'=>$this->user_sub_activities
            ->where('isAccepted', 0)->values()
            ->load(['term_sub_activity'=>function($q){
                if ($q->where('measurment','quality')) {
                  return  $qn[]= $q->where('measurment','qualitym')->get();

                }
               else if ($q->where('measurment','quality')) {
                   return $qn[]= $q->where('measurment','quality')->get();

                }
            }]),



        ];
    }
}
