<?php

namespace App\Http\Middleware;

use App\Models\Admin\Iprange;
use Closure;
use Illuminate\Http\Request;

class BlockIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $ipranges = Iprange::all();
      $IPwhiteList = array();
      foreach($ipranges as  $iprange){
      if(!is_null($iprange)){
        $ip1 = ip2long($iprange->start_ip);
        $ip2 = ip2long($iprange->end_ip);

        while ($ip1 <= $ip2) {
          $IPwhiteList[] = (long2ip($ip1));
          $ip1++;
        }
      }
    }

    //  dump($request->getClientIp());
      
      if (!in_array($request->getClientIp(), $IPwhiteList)) {
          abort(403, "You are restricted to access the site.");
        }
      
      
      return $next($request);
    }

}

