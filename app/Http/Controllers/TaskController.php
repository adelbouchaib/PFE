<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Projet;


use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    
    public function create(Request $request)
    {
        $projet = Projet::findOrFail($request->projet_id);
        $tasks = Task::where('projet_id','=',$projet->id)
        ->where('status','=','1')
        ->count();

        if($tasks != 0)
        {
            $projet->status = '1';
            $projet->save();
        }
        else{
            $projet->status = '0';
            $projet->save();
        }

        $task = new Task(); 
        $task->title = $request->title;
        $task->status = 0;
        $task->projet_id = $request->projet_id;
        $task->save();

        $projet = Projet::findOrFail($request->projet_id); 
        $projet->nbtasks ++;
        $projet->save();

       

        return redirect(route('admin.projet.index'));

    }

    public function destroy(Request $request)
    {


        $id = $request->id;
        $task = Task::find($id);
        $task->delete();

        $projet = Projet::findOrFail($request->projet_id); 
        $projet->nbtasks --;
        $projet->save();

        $tasks = Task::where('projet_id','=',$projet->id)
        ->where('status','=','1')
        ->count();

        $projet = Projet::findOrFail($request->projet_id);
        if($tasks != 0)
        {
            $projet->status = '1';
            $projet->save();
        }
        else{
            $projet->status = '0';
            $projet->save();
        }
        
        return redirect(route('admin.projet.index'));
    }

}
