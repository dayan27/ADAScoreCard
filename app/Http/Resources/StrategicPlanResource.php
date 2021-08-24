<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\StrategicPlan;
use Illuminate\Http\Resources\Json\JsonResource;

class StrategicPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $yearCard=[];
        foreach($this->yearly_plans as $value) {
              $yearCard[]=$value->year_card;
            }

        

        return [
            'id'=>$this->id,
            'action'=>$this->action,
            'perspective'=>$this->perspective->title,
            'to'=>$this->to,
            'from'=>$this->from,
            'phase'=>$this->phase,
            'departments'=>$this->departments,
            'yearly_plan'=>$this->yearly_plans,
            'year_card'=>$yearCard,
            'all_dept'=>Department::all(),

            // 'secret' => $this->when(Auth::user()->isAdmin(), function () {
            //     return 'secret-value';
            // }),
        ];
    }

}
