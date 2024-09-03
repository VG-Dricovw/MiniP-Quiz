<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <?php
foreach (['danger', 'warning', 'success', 'info'] as $alert) {
    $exist = Session::has($alert);

    if ($exist) {
        $msg = Session::get($alert);
    ?>
    <div class="alert text-white bg-blue-800 ml-3 mt-3 p-2 w-20 alert-<?=$alert?>"><?=$msg?></div>
    <?php
    }
}
?>

    {{$slot}}

</body>

</html>