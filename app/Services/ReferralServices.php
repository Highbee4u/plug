<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\ReferralCode;
use App\Services\GeneratorService;

class ReferralServices
{
     //
     public function generate_Code($userID)
     {
         $referral_code = (new GeneratorService())->generate_string_code(10, 'referral_codes', 'code');
 
        $insertReferral = ReferralCode::create([
            'code'=>$referral_code,
            'user_id' => $userID
        ]);

        return $referral_code;
     }
 
     public function get_user_id_by_referal_code($code)
     {
         $detail = ReferralCode::where('code', '=', $code)->first();
 
         return $detail;
     }
 
 
     public function get_referral_code_by_user_id($id)
     {
         
         $data = ReferralCode::where('user_id', '=', $id)->first();
 
         return $data;
     }
 
}
?>