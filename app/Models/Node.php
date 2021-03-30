<?php

namespace App\Models;

use App\Traits\AuxPaginate;
use App\Traits\convertFlatten;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory, SoftDeletes, AuxPaginate,convertFlatten;

    /**
     * @var string[]
     */
    protected $fillable = ['name','parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(Node::class,'parent_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parents() {
        return $this->parent()->with('parents');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(Node::class,'parent_id','id');
    }


}
