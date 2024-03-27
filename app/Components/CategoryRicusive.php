<?php

namespace App\Components;
use App\Models\Categories;

class CategoryRicusive
{
    private $html;
    public function __construct()
    {
        $this->html = "";
    }

    function categoryRicusiveAdd(){
        $data = Categories::all();

        foreach ($data as $dataItem) {
            $this->html .= '<option value='. "'$dataItem->id'" .'>' . $dataItem->name.'</option>';
        }

        return $this->html;
    }

    function getCategory($categoryId){
        $data = Categories::all();

        foreach ($data as $dataItem) {
            if($categoryId == $dataItem->id){
                $this->html .= '<option selected value='. "'$dataItem->id'" .'>' . $dataItem->name.'</option>';
            }else{
                $this->html .= '<option value='. "'$dataItem->id'" .'>' . $dataItem->name.'</option>';
            }
        }
        return $this->html;
    }
}
