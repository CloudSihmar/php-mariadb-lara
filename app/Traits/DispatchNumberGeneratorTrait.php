<?php
namespace App\Traits;

trait DispatchNumberGeneratorTrait
{
    //model, 'doc_id', 'DN', 5)
    public static function DispatchNumberGenerator($model, $trow, $prefix, $length = 4){
        $year = Date('Y');
        $data = $model::where('year',$year)->where('dORr',1)->get()->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = $data->$trow;//substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ((int)$code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.$zeros.$last_number;
    }
  
}
