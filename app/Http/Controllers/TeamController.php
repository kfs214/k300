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

        $filters[] = ['user_id', auth()->user()->id];
/*        if( $sort == 't12acode' ){
            $members = TeamMember::where('user_id', auth()->user()->id)->orderBy($direction)->paginate(20);
        }敗北の記録*/


        //取得系
        $members_count = TeamMember::where( $filters )->count();

        $animal_groups = AnimalService::animal_groups();
        $grouped_animals = $animal_groups['grouped_animals'];
        $animal_groups = $animal_groups['animal_groups'];

        $search_by = AnimalService::searchBy($animal_groups, $request, $filters, 'team');

        $filters = $search_by['filters'];
        $selected_animals = $search_by['selected_animals'];
      

        //いよいよ系
        $members = TeamMember::where( $filters )->join('animals', 'animals.id', '=', 'team_members.acode')/*->join('animal_groups', 'animal_groups.t12aname', '=', 'animals.t12aname')*/->orderBy($sort, $direction)->paginate(20);

        $params = ['selected_animals', 'grouped_animals', 'animal_groups', 'members', 'members_count'];

        return view('home.team', compact( $params ));
    }



    public function store(DateRequest $request, TeamMember $team_member){
      $data = $request->validate(
        ['name' => 'required| string| max:15',
        'birthday' =>'required| date_format:"Y-m-d"',
      ]);
      $acode = AnimalService::acode($data['birthday']);
      $user_id = auth()->user()->id;
      $data += compact('acode', 'user_id');

      $team_member->fill($data)->save();
      session()->forget('filters');
      return redirect(route( 'team.index' ))->with('status', '追加が完了しました');
    }
}
