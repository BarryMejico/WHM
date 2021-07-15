<?php

namespace App\Http\Middleware;

use Closure;
use LengthException;

class checkPermCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $head=$request->headers;
        dd($next);
        $menu=[];
        $menu=listofmenu();
        $countarray = count($menu)-1;
        for($i=0;$i<=$countarray;$i++){     
            if($menu[$i]['id']==$request->headers){
                return $next($request);
            }
        };
        
    }
}
