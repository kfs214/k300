<?php

namespace App\Http\Middleware;

use Closure;
use App\Board;
use Illuminate\Support\Facades\Auth;

class HiddenBoardMiddleware
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
        $shown_id = $request->route()->parameter( 'shown_id' );

        $board = Board::where( compact('shown_id' ))->first();

        if( $board->hidden ){
          $members = $board->users()->pluck('id');
          if( !$members->contains( Auth::id() ) ){
             abort(403);
          }
        }

        return $next($request);
    }
}
