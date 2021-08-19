<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

trait ApiResponser{

    private function successResponse($data,$code){

        return response()->json($data,$code);
    }

    protected function errorResponse($message,$code){
        return response()->json(['error'=>$message],$code);
    }

    protected function showAll(Collection $collection,$code=200){
        $collection=$this->filterData($collection);
        $collection=$this->sortData($collection);
        return $this->successResponse($collection,$code);
    }

    protected function sortData(Collection  $collection){

         if (request()->has('sort_by')) {

           //  $attribute= ApiResponser::originalAttributes(request('sort_by'));

             $newCollection=$collection->sortBy(request()->sort_by);
             return $newCollection->values()->all();
         }
     return $collection;
    }


    protected function filterData(Collection $collection){

        foreach (request()->query() as $query => $value) {
         //   $attribute=ApiResponser::originalAttributes($query);
            if (isset($query,$value)) {
                $newCollection=$collection->where($query,$value);
                return $newCollection->values()->all();

            }
        }
       
        return $collection;
    }

    public static function originalAttributes($index){

        $attributes=[
            'identifier'=>'id',
            'description'=>'detail',
            'product_name'=>'name',
            'price'=>'price',
            'status'=>'status',
            'product_images'=>'images',
            'product_rating'=>'rating',
        ];

        return $attributes[$index]!=null?$attributes[$index]:$index;
    }

    //Orginal for collections and models
    // private function successResponse($data,$code){

    //     return response()->json($data,$code);
    // }

    // protected function errorResponse($message,$code){
    //     return response()->json(['error'=>$message,'code'=>$code],$code);
    // }

    // protected function showAll(Collection $collection,$code=200){
    //     return $this->successResponse(['data'=>$collection],$code);
    // }

    // protected function showOne( Model $model ,$code=200){
    //     return $this->successResponse(['data'=>$model],$code);
    // }
}