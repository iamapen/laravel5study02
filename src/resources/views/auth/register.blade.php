<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
<h1>ユーザ登録フォーム</h1>
<form name="registForm" action="/auth/register" method="post">
  {{csrf_field()}}
  名前：<input type="text" name="name" size="30"><span>{{$errors->first('name')}}</span><br>
  email：<input type="text" name="email" size="30"><span>{{$errors->first('email')}}</span><br>
  パスワード：<input type="password" name="password" size="30"><span>{{$errors->first('password')}}</span><br>
  パスワード確認：<input type="password" name="password_confirmation" size="30"><span>{{$errors->first('password_confirmation')}}</span><br>
  <button type="submit" name="action" value="send">送信</button>
</form>
</body>
</html>
