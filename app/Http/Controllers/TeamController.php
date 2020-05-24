<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamMember;
use App\Animal;
use App\Http\Requests\DateRequest;
use App\Services\AnimalService;

class TeamController extends Controller
{
    public function index(Request $request){
        //初期化系
        $sort = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';

        $selected_animals = [
          'acode' => '',
          't12aname' => '',
          'rhythm' => '',
        ];

        $filters[] = ['user_id', auth()->user()->id];

/*        if( $sort == 't12acode' ){
            $team_members = TeamMember::where('user_id', auth()->user()->id)->orderBy($direction)->paginate(20);
        }敗北の記録*/


        //取得系
        $team_members_count = TeamMember::where( $filters )->count();

        $t3anames = Animal::distinct()->pluck('t3aname');

        $t12anames_temp = Animal::select('t12aname', 't3aname', 't4code')->distinct()->get();
        $collection = collect($t12anames_temp);
        $t12anames_temp = $collection->sortBy('t4code');

        $rhythms = Animal::distinct()->pluck('rhythm');

        foreach( $t12anames_temp as $t12aname){
            $grouped_animals[$t12aname->t3aname][$t12aname->t12aname] = Animal::select('id', 'aname')->where('t12aname', $t12aname->t12aname)->get();
        }

        foreach( $t12anames_temp as $t12aname){
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

        $animal_groups = ['t3anames' => $t3anames, 't12anames' => $t12anames, 'rhythms' => $rhythms,];
//        dd($animal_groups);

        //絞り込み系
        if( $search_by = $request->search_by ){
            if( $search_by == 'acode' ){
                $filters[] = ['acode', $request->acode,];
                $selected_animals['acode'] = $request->acode;
            }elseif( $search_by == 'groups' ){
//                if( in_array( $request->t12aname, $t3anames) ){
//                   $filters[] = ['t3aname', $request->t12aname,];
//                }
            }

        }


        //いよいよ系
        $team_members = TeamMember::where( $filters )->join('animals', 'animals.id', '=', 'team_members.acode')/*->join('animal_groups', 'animal_groups.t12aname', '=', 'animals.t12aname')*/->orderBy($sort, $direction)->paginate(20);

        $params = ['selected_animals', 'grouped_animals', 'animal_groups', 'team_members', 'team_members_count'];

        return view('home.team', compact( $params ));
    }



    public function store(DateRequest $request, TeamMember $team_member){
      $data = $request->validate(
        ['name' => 'required| string| max:255',
        'birthday' =>'required| date_format:"Y-m-d"',
      ]);
      $acode = AnimalService::acode($data['birthday']);
      $user_id = auth()->user()->id;
      $data += compact('acode', 'user_id');

      $team_member->fill($data)->save();
      return redirect(route( 'team.index' ))->with('status', '追加が完了しました');
    }
}
