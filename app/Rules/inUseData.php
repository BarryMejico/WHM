<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Customer;
use App\Cusstomer_Device;
use App\po_list; 
use App\item;
use App\poDetails;

class inUseData implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($attribute=="Ccode"){
        $customer = Cusstomer_Device::where('Ccode',$value)->count();
        //dd($customer);
        if ($customer==0){
            return true;
        }
        }

        elseif ($attribute=="Vcode"){
            $Vendor = po_list::where('Vendor',$value)->count();
            //dd($customer);
            if ($Vendor==0){
                return true;
            }
            }

            elseif ($attribute=="ids"){
                $item = poDetails::where('Icode',$value)->count();
                //dd($value);
                if ($item==0){
                    return true;
                }
                }


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the data is already in use.';
    }
}
