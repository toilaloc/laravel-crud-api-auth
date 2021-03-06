<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Service\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ResponseAPITrait;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ResponseAPITrait;
    private $postService;
    private $resourcePath = "\App\Http\Resources\Post";
    public function __construct()
    {
        $this->postService = new PostService();
    }

    public function index()
    {
        $getAllPost = $this->postService->getAllPost();
        $info = [
            'status' => true,
            'message' => 'All posts fetched successfully',
        ];
        return $this->responseAPI($getAllPost, $this->resourcePath, $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $postDataStore = $request->validated();
        return response()->json($this->postService->storePost($postDataStore));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postDataToShow = $this->postService->showPost($id);
        return response()->json($postDataToShow);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        $postDataUpdate = $request->validated();
        return response()->json($this->postService->updatePost($postDataUpdate,$id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json($this->postService->deletePost($id));
    }
}
