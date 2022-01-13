<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
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
            ['status', '=', 1],
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
        $action = "list";
        $types = Creature::select('type')->distinct()->get()->pluck('type');
        $filter_type = "";
        $term = "";
        if(isset($request->filter_type) && $request->filter_type !== ""){
            $filter_type = $request->filter_type;
        }
        if(isset($request->term) && $request->term !== ""){
            $search_term = $request->term;
        } else {
            $search_term = "Search creatures";
        }
        $data = Creature::where([
            ['status', '=', 1],
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('type', 'LIKE', '%' . $term . '%')->get();
                }
                if(($type = $request->filter_type)){
                    if($type !== ""){
                        $query->where('type', '=', $type)->get();
                    }
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('creatures.admin', ["data" => $data, "types" => $types, "filter_type" => $filter_type, "search_term" => $search_term])
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function review(Request $request)
    {
        $action = "review";
        $types = Creature::select('type')->distinct()->get()->pluck('type');
        $filter_type = "";
        if(isset($request->filter_type) && $request->filter_type !== ""){
            $filter_type = $request->filter_type;
        }
        if(isset($request->term) && $request->term !== ""){
            $search_term = $request->term;
        } else {
            $search_term = "Search creatures";
        }
        $data = Creature::where([
            ['status', '=', 0],
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('type', 'LIKE', '%' . $term . '%')->get();
                }
                if(($type = $request->filter_type)){
                    if($type !== ""){
                        $query->where('type', '=', $type)->get();
                    }
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        return view('creatures.index', ["data" => $data, "types" => $types, "filter_type" => $filter_type, "action" => $action, "search_term" => $search_term])
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
           'user_id' => 'required',
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
        return view('creatures.edit',compact('creature'));
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
        $request->validate([
            'user_id' => 'required',
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
