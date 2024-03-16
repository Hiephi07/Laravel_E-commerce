<?php

namespace App\Components;
use App\Models\Menus;

class MenuRicusive
{
    private $html;
    public function __construct()
    {
        $this->html = "";
    }

    function menuRicusiveAdd($parentID = 0, $subMark = ""){
        $data = Menus::where("parent_id", $parentID)->get();

        foreach ($data as $dataItem) {
            $this->html .= '<option value='. "'$dataItem->id'" .'>' . $subMark . $dataItem->name.'</option>';
            $this->menuRicusiveAdd($dataItem->id, $subMark . "--");
        }

        return $this->html;
    }

    function menuRicusiveEdit($parentIdMenuEdit, $parentID = 0, $subMark = ""){
        $data = Menus::where("parent_id", $parentID)->get();

        foreach ($data as $dataItem) {
            if($parentIdMenuEdit == $dataItem->id){
                $this->html .= '<option selected value='. "'$dataItem->id'" .'>' . $subMark . $dataItem->name.'</option>';
            }else{
                $this->html .= '<option value='. "'$dataItem->id'" .'>' . $subMark . $dataItem->name.'</option>';
            }

            $this->menuRicusiveEdit($parentIdMenuEdit, $dataItem->id, $subMark . "--");
        }
        return $this->html;
    }
}
