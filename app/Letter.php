<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Letter extends Model
{
    public function getRouteKey(): string{
        return Hashids::connection('letter_id')->encode($this->getKey());
    }
    
    public function resolveRouteBinding($value): ?Model{
        $value = Hashids::connection('letter_id')->decode($value)[0] ?? null;
        
        return $this->where($this->getRouteKeyName(), $value)->first();
    }
    
    public function from_user(){
        return $this->hasOne('App\User', 'id', 'from_user_id');
    }
}
