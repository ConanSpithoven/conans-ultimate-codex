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
    public function index()
    {
        $data = Creature::where('status', 'review')->get();
        return view('creatures.index', ['data' => $data]);
    }

    public function admin()
    {
        $data = Creature::latest()->paginate(5);
        return view('creatures.admin', compact('data'))->with('i', (request()->input('page', 1) -1) *5);
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
       ]);
   
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
        ]);
    
        $creature->update($request->all());
    
        return redirect()->route('creatures.index')
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
    
        return redirect()->route('creatures.index')
                        ->with('success','Creature deleted successfully');
    }
}
