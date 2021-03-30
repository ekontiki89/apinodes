<?php

namespace App\Http\Controllers\Api\V2;

use App\Exceptions\ChildException;
use App\Exceptions\ParentException;
use App\Exceptions\ParentIsRoot;
use App\Exceptions\ParentIsRootException;
use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Node\NodeResource;
use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class NodeController extends Controller
{
    protected $node;
    const PERPAGE = 2;

    /**
     * NodeController constructor.
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @param $id
     * @return get all parents
     * @throws ParentException
     */
    public function parents($id){
        $children = $this->node->with('parents')->findOrFail($id);
        if(is_null($children->parents)){
            throw new ParentException();
        }
        $res =  $this->node->flatten($children->toArray());
        $collect = collect($res);
        $paginate = $this->node->auxPaginate($collect,self::PERPAGE);
        return NodeResource::collection($paginate);
    }

    /**
     * @param $id
     * @return get all children
     * @throws ChildException
     */
    public function children($id){
        $parent = $this->node->with('children')->findOrFail($id);
        if(count($parent->children) == 0 ){
            throw new ChildException();
        }
        $res =  $this->node->flatten($parent->toArray());
        $collect = collect($res);
        $paginate = $this->node->auxPaginate($collect,self::PERPAGE);
        return  NodeResource::collection($paginate);
    }
}
