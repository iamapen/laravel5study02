<html>
<head>
  <title>Laravel Gate Example</title>
</head>
<body>

<div class="container">
  sample content

  {{-- policyを呼べる --}}
  @can('edit', $content)
    <button>編集</button>
  @endcan
</div>

</body>
</html>
