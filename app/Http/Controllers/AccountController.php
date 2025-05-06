<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(Request $request){
        \App\Models\Manu::create($request->all());
        return redirect()->route('manu.index');
    }

    public function update(Request $request, $id){
        $manu = \App\Models\Manu::find( $id );
        $manu->update($request->all());
        $manu->save();
        return redirect()->route('manu.index');
    }
    public function destroy($id){
        \App\Models\Manu::find($id)->delete();
        return response('success');
    }
}
