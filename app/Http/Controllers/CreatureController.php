<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CreatureController extends Controller
{
    function __construct()
    {
         //$this->middleware('permission:creature-list|creature-create|creature-edit|creature-delete', ['only' => ['index','show']]);
         $this->middleware('permission:creature-create', ['only' => ['create','store']]);
         $this->middleware('permission:creature-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:creature-delete', ['only' => ['destroy']]);
         $this->middleware('permission:creature-review', ['only' => ['review']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $action = "list";
        $sizes = Creature::select('size')->distinct()->get()->pluck('size');
        $types = Creature::select('type')->distinct()->get()->pluck('type');
        $alignments = Creature::select('alignment')->distinct()->get()->pluck('alignment');
        $filter_size = "";
        if(isset($request->filter_size) && $request->filter_size !== ""){
            $filter_size = $request->filter_size;
        }
        $filter_type = "";
        if(isset($request->filter_type) && $request->filter_type !== ""){
            $filter_type = $request->filter_type;
        }
        $filter_alignment = "";
        if(isset($request->filter_alignment) && $request->filter_alignment !== ""){
            $filter_alignment = $request->filter_alignment;
        }
        if(isset($request->term) && $request->term !== ""){
            $search_term = $request->term;
        } else {
            $search_term = "Search creatures";
        }
        $data = Creature::where([
            ['status', '=', 'approved'],
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($size = $request->filter_size)){
                    if($size !== ""){
                        $query->Where('size', '=', $size);
                    }
                }
                if(($type = $request->filter_type)){
                    if($type !== ""){
                        $query->Where('type', '=', $type);
                    }
                }
                if(($alignment = $request->filter_alignment)){
                    if($alignment !== ""){
                        $query->Where('alignment', '=', $alignment);
                    }
                }
            }],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%');
                    $query->orWhere('type', 'LIKE', '%' . $term . '%');
                }
                $query->get();
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('creatures.index', ["data" => $data, "sizes" => $sizes, "filter_size" => $filter_size, "types" => $types, "filter_type" => $filter_type, "alignments" => $alignments, "filter_alignment" => $filter_alignment, "action" => $action, "search_term" => $search_term])
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function admin(Request $request)
    {
        if(Auth::check()){
            $action = "list";
            $sizes = Creature::select('size')->distinct()->get()->pluck('size');
            $types = Creature::select('type')->distinct()->get()->pluck('type');
            $alignments = Creature::select('alignment')->distinct()->get()->pluck('alignment');
            $filter_size = "";
            if(isset($request->filter_size) && $request->filter_size !== ""){
                $filter_size = $request->filter_size;
            }
            $filter_type = "";
            if(isset($request->filter_type) && $request->filter_type !== ""){
                $filter_type = $request->filter_type;
            }
            $filter_alignment = "";
            if(isset($request->filter_alignment) && $request->filter_alignment !== ""){
                $filter_alignment = $request->filter_alignment;
            }
            $term = "";
            if(isset($request->term) && $request->term !== ""){
                $search_term = $request->term;
            } else {
                $search_term = "Search creatures";
            }

            $user_id = Auth::id();
            $role_ids = DB::table('model_has_roles')->where('model_id', '=', $user_id)->get()->pluck('role_id')->toArray();

            $data = Creature::where([
                ['name', '!=', Null],
                [function ($query) use ($user_id, $role_ids){
                    if(! in_array(1, $role_ids)){
                        $query->Where('user_id', '=', $user_id);
                    }
                }],
                [function ($query) use ($request){
                    if(($size = $request->filter_size)){
                        if($size !== ""){
                            $query->Where('size', '=', $size);
                        }
                    }
                    if(($type = $request->filter_type)){
                        if($type !== ""){
                            $query->Where('type', '=', $type);
                        }
                    }
                    if(($alignment = $request->filter_alignment)){
                        if($alignment !== ""){
                            $query->Where('alignment', '=', $alignment);
                        }
                    }
                }],
                [function ($query) use ($request){
                    if(($term = $request->term)) {
                        $query->orWhere('name', 'LIKE', '%' . $term . '%');
                        $query->orWhere('type', 'LIKE', '%' . $term . '%');
                    }
                    $query->get();
                }]
            ])
                ->orderBy("id", "desc")
                ->paginate(10);
            return view('creatures.admin', ["data" => $data, "sizes" => $sizes, "filter_size" => $filter_size, "types" => $types, "filter_type" => $filter_type, "alignments" => $alignments, "filter_alignment" => $filter_alignment, "action" => $action, "search_term" => $search_term])
                ->with('i', (request()->input('page', 1) -1) *5);
        } else {
            return($this->index($request));
        }
    }

    public function review(Request $request)
    {
        $action = "review";
        $sizes = Creature::select('size')->distinct()->get()->pluck('size');
        $types = Creature::select('type')->distinct()->get()->pluck('type');
        $alignments = Creature::select('alignment')->distinct()->get()->pluck('alignment');
        $filter_size = "";
        if(isset($request->filter_size) && $request->filter_size !== ""){
            $filter_size = $request->filter_size;
        }
        $filter_type = "";
        if(isset($request->filter_type) && $request->filter_type !== ""){
            $filter_type = $request->filter_type;
        }
        $filter_alignment = "";
        if(isset($request->filter_alignment) && $request->filter_alignment !== ""){
            $filter_alignment = $request->filter_alignment;
        }
        if(isset($request->term) && $request->term !== ""){
            $search_term = $request->term;
        } else {
            $search_term = "Search creatures";
        }
        $data = Creature::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($size = $request->filter_size)){
                    if($size !== ""){
                        $query->Where('size', '=', $size);
                    }
                }
                if(($type = $request->filter_type)){
                    if($type !== ""){
                        $query->Where('type', '=', $type);
                    }
                }
                if(($alignment = $request->filter_alignment)){
                    if($alignment !== ""){
                        $query->Where('alignment', '=', $alignment);
                    }
                }
            }],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%');
                    $query->orWhere('type', 'LIKE', '%' . $term . '%');
                }
                $query->get();
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('creatures.index', ["data" => $data, "sizes" => $sizes, "filter_size" => $filter_size, "types" => $types, "filter_type" => $filter_type, "alignments" => $alignments, "filter_alignment" => $filter_alignment, "action" => $action, "search_term" => $search_term])
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function changeReviewStatus(Request $request)
    {
        if($request->status == "approved" || $request->status == 'review'){
            Creature::where('id', $request->creature_id)->update(array('status' => $request->status));
        }
  
        // if 10th item to get approved for this user, make em a moderator

        return response()->json(['success'=>'creature review status changed successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Auth::check()){
            // not logged in
            return route('login');
        }
        return view('creatures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $request->request->add(["user_id" => $user_id]);
        $request->validate([
           'name' => 'required',
           'size' => 'required',
           'type' => 'required',
           'alignment' => 'required'
       ]);
       
       $data = $request->only('size', 'type', 'alignment');
       $field_validation = $this->validate_fields($data, $request);

        if($field_validation){
            return back()->withErrors([$field_validation])
                    ->withInput($request->input());
        }
        
       Creature::create($request->all());
    
       return redirect()->route('creatures.index')
                       ->with('success','Creature created successfully.');
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function show(Creature $creature)
    {
        return view('creatures.show',compact('creature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function edit(Creature $creature)
    {
        if(! Auth::check()){
            // not logged in
            return route('login');
        }
        return view('creatures.edit', compact('creature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creature $creature)
    {
        if(! Auth::check()){
            // not logged in
            return route('login');
        }
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'type' => 'required'
        ]);

        $data = $request->only('size', 'type', 'alignment');
        $field_validation = $this->validate_fields($data, $request);

        if($field_validation){
            return back()->withErrors([$field_validation])
                    ->withInput($request->input());
        }

        $creature->update($request->all());
    
        return redirect()->route('creatures.admin')
                        ->with('success','Creature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creature $creature)
    {
        if(! Auth::check()){
            // not logged in
            return route('login');
        }
        $creature->delete();
    
        return redirect()->route('creatures.admin')
                        ->with('success','Creature deleted successfully');
    }

    private function validate_fields($data, $request){
       $size_validated = false;
       $type_validated = false;
       $alignment_validated = false;

       foreach(['Tiny', 'Small', 'Medium', 'Large', 'Huge', 'Gargantuan', 'Massive'] as $size){
            if($data["size"] == $size){
                $size_validated = true;
            }
       }

       foreach(['Abberation', 'Beast', 'Elemental', 'Plant', 'Humanoid'] as $type){
            if($data["type"] == $type){
                $type_validated = true;
            }
        }

        foreach(["Lawful Neutral", "True Neutral", "Chaotic Neutral", "Lawful Evil", "Neutral Evil", "Chaotic Evil", "Lawful Good", "Neutral Good", "Chaotic Good"] as $alignment){
            if($data["alignment"] == $alignment){
                $alignment_validated = true;
            }
        }

        if(!$size_validated){
           return 'Size is not an allowed value';
        }

        if(!$type_validated){
            return 'Type is not an allowed value';
        }

        if(!$alignment_validated){
            return 'Alignment is not an allowed value';
        }

        return false;
    }
}
