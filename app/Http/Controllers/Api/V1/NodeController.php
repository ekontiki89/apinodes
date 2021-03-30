<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ChildException;
use App\Exceptions\ParentException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Node\ChildrenResource;
use App\Http\Resources\V1\Node\NodeCollection;
use App\Http\Resources\V1\Node\NodeResource;
use App\Models\Node;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class NodeController extends Controller
{
    protected $node;

    /**
     * NodeController constructor.
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    public function parents($id){

        $children = $this->node->with('parents')->findOrFail($id);
        if(is_null($children->parents)){
            throw new ParentException();
        }
        return new NodeResource($children);

    }


    public function children($id){
        $parent = $this->node->with('children')->findOrFail($id);
        if(count($parent->children) == 0 ){
            throw new ChildException();
        }
        return new ChildrenResource($parent);
    }
}
