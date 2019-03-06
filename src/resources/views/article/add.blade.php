<html lang="">
<head>
  <title></title>
  <meta charset="UTF-8">
</head>
<body>
<h1>記事投稿フォーム</h1>

<ul>
@if(count($errors) > 0)
  @foreach($errors->all() as $errmsg)
    <li>{{$errmsg}}</li>
  @endforeach
@endif
</ul>

<form name="registForm" action="/articles" method="post">
  {{csrf_field()}}
  名前：<label><input type="text" name="name" size="30"><span>{{$errors->first('name')}}</span></label><br>
  email：<label><input type="text" name="email" size="30"><span>{{$errors->first('email')}}</span></label><br>
  age：<label><input type="text" name="age" size="3"><span>{{$errors->first('age')}}</span></label><br>
  成人向けメルマガ：
  <label><input type="radio" name="magazine" value="allow">購読する</label>
  <label><input type="radio" name="magazine" value="disallow">購読しない</label>
  <br>
  <button type="submit" name="action" value="send">送信</button>
</form>
</body>
</html>
