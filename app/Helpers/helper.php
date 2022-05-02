<?php


namespace App\Helpers;
use Carbon\Carbon;
use App\Models\User;

class Helper{

    public static function matricule($direction, $date, $sexe){
          
        $annee=Carbon::createFromFormat('Y-m-d', $date)->format('Y');
          $annee2 = substr($annee,strlen($annee)-2);

          switch($direction)
            {
                  case 1:
                      $direction = "DG";
                      break;
  
            }

          $mat= $direction .$annee2 .$sexe;

          
        $data= User::orderBy('id','desc')->where('matricule','LIKE',$mat .'%')->first();
        $data2 = substr($data->matricule,strlen('DG22F'));

        $actial_last_number = ($data2/1)*1;
        
        $increment_last_number = $actial_last_number+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = 3 - $last_number_length;
            $last_number = $increment_last_number;

            $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $mat.$zeros.$last_number;


       
        

          


        //   $direction = 1;
        //   switch($direction)
        //   {
        //         case 0:
        //         case 1:
        //             echo "0";
        //             break;
        //         case 3:
        //             echo "1";
        //             break;
        //         case 4:
        //             echo "2";
        //             break;    

        //   }


        // $mat= $direction .$annee .$sexe;
        // $data= $model::orderBy('id','desc')->where('matricule','LIKE','%' .$mat)->get();
        
     
    }
}
?>