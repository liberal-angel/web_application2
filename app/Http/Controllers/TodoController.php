<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TodoClientRequest;
use App\Models\Todo;
use App\Models\Tag;
use App\Models\User;

class TodoController extends Controller
{

    public function index(){
        $user = Auth::user();
        $Todos = Todo::all();
        $Tags = Tag::all();
        $data = [
            'Todos'=>$Todos,
            'Tags'=>$Tags,
            'user'=>$user
        ];
        return view('index', $data);
    }

    public function create(TodoClientRequest $request){
        $todo = $request -> only('task','tag_id','user_id');
        Todo::create($todo);
        return redirect('/');
    }

    public function update(Request $request){
        $this->validate($request,[
            'task' => ['required','max:20']
            ],[
                'task.required' => '※この項目は入力必須です',
                'task.max' => '※この項目は２０文字以上です'
        ]);
        $data = $request -> only('task','tag_id');
        Todo::where('id', $request -> id)->update($data);
        return redirect('/');
    }

    public function delete(Request $request){
        $data = $request -> only('task');
        Todo::where('id', $request -> id)->delete();
        return redirect('/');
    }

    public function search(){
        $user = Auth::user();
        $user = [
            'user'=>$user
        ];
        return view('search', $user);
    }
    public function search_update(Request $request){
        $user = Auth::user();
        $Tags = Tag::all();
        $this->validate($request,[
            'task' => ['required','max:20']
            ],[
                'task.required' => '※この項目は入力必須です',
                'task.max' => '※この項目は２０文字以上です'
        ]);
        $data = $request -> only('task','tag_id');
        Todo::where('id', $request -> id)->update($data);
        $Todos = Todo::where('id', $request -> id)->get();
        $param = [
            'user'=>$user,
            'Todos'=>$Todos,
            'Tags'=>$Tags
        ];
        return view('search',$param);
    }
    public function search_post(Request $request){
        $user = Auth::user();
        if($request->task && $request->tag_id){
            $Todos = Todo::where('task', $request->task)->where('tag_id', $request->tag_id)->get();
        }elseif($request->task && !$request->tag_id){
            $Todos = Todo::where('task', 'LIKE BINARY', "%{$request->task}%")->get();
        }elseif($request->tag_id && !$request->task){
            $Todos = Todo::where('tag_id', $request->tag_id)->get();
        }elseif(!$request->task && !$request->tag_id){
            $error = '※タスク、又はタグのいずれかを入力してください';
        }
        if(isset($Todos)){
        $Tags = Tag::all();
        $param = [
            'task' => $request->task,
            'Tags' => $Tags,
            'Todos' => $Todos,
            'user' => $user,
        ];
        }else($param = [
            'task' => $request->task,
            'user' => $user,
            'error' => $error
        ]);
        return view('search', $param);
    }
}