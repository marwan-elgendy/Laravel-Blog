<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
    
    public function tags(){
        return $this->belongsToMany(tag::class);
    }

    public function hastag($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query){
        return $query->where('published_at','<=',now());
    }

    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){
            return $query->published();
        }

        return $query->published()->where('title','LIKE',"%{$search}%"); 
    }

    
}

