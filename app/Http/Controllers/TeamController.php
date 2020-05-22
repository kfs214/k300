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
        $sort = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';
/*        if( $sort == 't12acode' ){
            $team_members = TeamMember::where('user_id', auth()->user()->id)->orderBy($direction)->paginate(20);
        }敗北の記録*/
        $team_members = TeamMember::where('user_id', auth()->user()->id)->join('animals', 'animals.id', '=', 'team_members.acode')/*->join('animal_groups', 'animal_groups.t12aname', '=', 'animals.t12aname')*/->orderBy($sort, $direction)->paginate(20);
        return view('home.team', compact('team_members'));
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
