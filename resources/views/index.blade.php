<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <title>index_php</title>
  <style>
    .home{
      position: relative;
      background-color: #2d197c;
      height: 100vh;
      width: 100vw;
    }
    .list{
      display: inline-block;
      border: black solid 1px;
      border-radius: 10px;
      padding: 10px 20px;
      width: 600px;
      background-color: white;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .ttl {
      font-size: 18px;
      margin: 0px;
    }
    .error_box{
      font-size: 5px;
    }
    .error_list{
      padding-left: 15px;
    }
    .error_message{
      display: inline-block;
      list-style: none;
      padding: 0px 10px;
      background-color: #ffc9c9;
    }
    .create_box{
      width: 100%;
      margin: 10px;
    }
    .create_input{
      width: 80%;
    }
    .table_list{
      margin: 10px 0;
      width: 100%;
    }
    .txt_area{
      width:90%;
    }
    .create_button{
      border: #ff97f2 solid 2px;
      background-color: white;
      border-radius: 5px;
      font-weight: bold;
      color: #ff57f2;
      cursor: pointer;
      padding: 2px 7px;
    }
    .update_button{
      border: #ffbc80 solid 2px;
      background-color: white;
      border-radius: 5px;
      font-weight: bold;
      color: #ffbc80;
      cursor: pointer;
      padding: 5px 8px;
    }
    .delete_button{
      border: #a6ff7e solid 2px;
      background-color: white;
      border-radius: 5px;
      font-weight: bold;
      color: #a6ff7e;
      cursor: pointer;
      padding: 5px 8px;
    }
    .login_user{
      margin: 0;
    }
    .ttl-box{
      display: flex;
      justify-content: space-around;
    }
    .search_button{
      margin: 10px 0;
    }
  </style>
</head>

<body>
  <div class="home">
    <div class="list">
      <div class="ttl-box"> <!-- タイトル -->
        <h1 class="ttl">Todo List</h1>
        <!-- @if (Auth::check()) @endif -->
        <p class="login_user">ログイン中のユーザー: {{$user->name}}</p>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <!-- ログインボタン -->
          <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              <input type="submit" value="ログアウト">
          </x-responsive-nav-link>
       </form>
      </div>

      @if(count($errors)>0) <!-- バリデーション -->
        <div class="error_box">
          <ul class="error_list">
            <li>
              <p>入力内容に下記の問題があります</p>
            </li>
            <li class="error_message">
              @error('task')
                <p>{{$message}}</p>
              @enderror
              @error('tag_id')
                <p>{{$message}}</p>
              @enderror
            </li>
          </ul>
        </div>
      @endif

      <div class="create_box"> <!-- 入力欄 -->
         <div class="search_button">
            <a href="/search">
              <button>タスク検索</button>
            </a>
         </div>
        <form action="/create" method="post">@csrf
          <label>
            <input type="text" name="task" class="create_input" value="{{ old('task') }}">
          </label>
           @if (Auth::check())
              <input type="hidden" name="user_id" value="{{$user->id}}">
           @endif
          <select name="tag_id">
            <option value="" selected hidden>選択</option>
            <option value="1">家事</option>
            <option value="2">勉強</option>
            <option value="3">運動</option>
            <option value="4">食事</option>
            <option value="5">移動</option>
          </select>
          <button class="create_button">追加</button>
        </form>
      </div>

      <table class="table_list"> <!-- 入力内容の表記 -->
          <tr>
            <th>作成時間</th>
            <th>タスク</th>
            <th>タグ</th>
            <th>更新</th>
            <th>削除</th>
          </tr>

        @foreach($Todos as $Todo)
          <tr style="text-align: center;">
            <td>{{$Todo->created_at}}</td>
            <form action="/update/{{$Todo['id']}}/{{$Todo['task']}}" method="post">@csrf
              <td><input type="text" name="task" value="{{$Todo->task}}" class="txt_area"></td>
              <td>
                <!-- tag_id呼び出し -->
                <select name="tag_id" >
                  @foreach ($Tags as $Tag)
                    @if(old('tag_id',$Todo->tag_id) === $Tag->tag_id))
                    <option value="{{ $Tag->tag_id }}" selected hidden>{{ $Tag->tag }}</option>
                    @else
                    <option value="{{ $Tag->tag_id }}" hidden> {{ $Tag->tag }}</option>
                    @endif
                  @endforeach
                  <option value="1">家事</option>
                  <option value="2">勉強</option>
                  <option value="3">運動</option>
                  <option value="4">食事</option>
                  <option value="5">移動</option>
                </select>
              </td>
              <td><button class="update_button">更新</button></td>
            </form>
            <form action="/delete/{{$Todo['id']}}" method="post">@csrf
              <input type="hidden" name="task" value="{{$Todo->task}}">
              <td><button class="delete_button">削除</button></td>
            </form>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</body>

</html>