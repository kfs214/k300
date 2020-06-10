<?php
namespace App\Services;

use App\Animal;
use App\User;
use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\Auth;

class AnimalService{
  static function acode($birthday){
    $ref_date = Carbon::createFromDate('1921-12-26');
    $birthday = Carbon::createFromDate($birthday);
    $interval = $ref_date->diffInDays($birthday);
    $acode = $interval % 60;
    if($acode == 0){
      $acode = 60;
    }

    return $acode;
  }


  public static function animal_groups(){
    $t3anames = Animal::distinct()->pluck('t3aname');

    $t12anames_temp = Animal::select('t12aname', 't3aname', 't4code')->distinct()->get();
    $collection = collect($t12anames_temp);
    $t12anames_temp = $collection->sortBy('t4code');
    $rhythms = Animal::distinct()->pluck('rhythm');

    foreach( $t12anames_temp as $t12aname){
        $grouped_animals[$t12aname->t3aname][$t12aname->t12aname] = Animal::select('id', 'aname')->where('t12aname', $t12aname->t12aname)->get();

        switch( $t12aname->t4code ){
          case 1:
              $t4aname = '左上';
              break;
          case 2:
              $t4aname = '右下';
              break;
          case 3:
              $t4aname = '右上';
              break;
          case 4:
              $t4aname = '左下';
              break;
        }

          $t12anames[$t4aname][] = $t12aname->t12aname;
    }

    $t12anames = collect($t12anames);
    $animal_groups = compact('t3anames' , 't12anames', 't12anames_temp', 'rhythms');

    return compact('animal_groups', 'grouped_animals');
  }


  public function getLink($query){
    if($query == Config::get('view.hidden')){
       return Config::get('view.hidden');
    }else{
        return '<a href="https://www.google.co.jp/search?q=動物占い+' . $query . '" target="_blank" title="この結果をGoogleで検索する">' . $query . '</a>';
    }
  }


  public static function searchBy($animal_groups, $request, $filters = [], $mode = 'members'){
    //初期化系
    $selected_animals = [
      'acode' => '',
      't12aname' => '',
      'rhythm' => '',
    ];

/*    if( url()->current() != url()->previous() ){
        session()->forget('filters');
    }*/
    
    //絞り込み準備
    $previous = preg_replace('/\?.*/', '', url()->previous());

    if( $request->url() != $previous ){
        session()->forget('filters');
    }elseif( $search_by = $request->search_by ){
      if( $search_by == 'none' ){
          session()->forget('filters');

      }elseif( $search_by == 'acode' ){
          $filters[] = ['acode', $request->acode,];
          if($mode != 'team'){
            $filters[] = ['type_shown', 7];
          }
          $selected_animals['acode'] = $request->acode;

      }elseif( $search_by == 'groups' ){
          if( $selected_animals['rhythm'] = $request->rhythm ){
              $filters[] = ['rhythm', $request->rhythm];
              if($mode != 'team'){
                $filters[] = ['type_shown', 7];
              }
          }

          if( $animal_groups['t3anames']->contains( $request->t12aname ) ){
             $filters[] = ['t3aname', $request->t12aname,];
             if($mode != 'team'){
               $filters[] = ['type_shown', '>=', 4];
             }

          }elseif( $animal_groups['t12anames_temp']->pluck('t12aname')->contains( $request->t12aname ) ){
             $filters[] = ['t12aname', $request->t12aname,];
             if($mode != 'team'){
               $filters[] = ['type_shown', '>=', 6];
             }

          }elseif( $request->t12aname ){
             $filters[] = ['t4code', $request->t12aname,];
             if($mode != 'team'){
               $filters[] = ['type_shown', '>=', 6];
             }

          }

          $selected_animals['t12aname'] = $request->t12aname;
          
        }

      }elseif( session('filters') ){
          $filters = session('filters');
          $selected_animals = session('selected_animals');
      }

      session()->flash('selected_animals', $selected_animals);
      session()->flash('filters', $filters);
      
      
      //並べ替え有効時、非公開設定のユーザーは表示しない。
      if( $request->sort && $mode != 'team'){
        switch( $request->sort ){
            case 'uname':
              $filters[] = ['name_shown', 1];
              break;
            case 'birthday':
              $filters[] = ['birthday_shown', 1];
              break;
            case 't12aname':
              $filters[] = ['type_shown', '>=', 6];
              break;
            case 't3aname':
              $filters[] = ['type_shown', '>=', 4];
              break;
            case 'acode':
            case 'rhythm':
              $filters[] = ['type_shown', 7];
              break;
        }
      }

      return compact('filters', 'selected_animals');
  }


  public function sortLinkGen($shown, $sort){
    return $shown . '
      <a href="' . url()->current() . '?sort=' . $sort . '&direction=asc">▲</a>
      <a href="' . url()->current() . '?sort=' . $sort . '&direction=desc">▼</a>';
  }
}

 ?>
