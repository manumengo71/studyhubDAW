<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/editor.js', 'resources/js/alpine.js'])

</head>
<body>

    <form class="space-y-4 md:space-y-6" x-data="editor({{ session('data') }}, true)"
    id="post-form"
        action="{{ route('prueba') }}"
        method="post" @submit.prevent="beforeSend">
        @csrf
        @method('put')

        <input type="hidden" name="description" id="description" value="">
        <div id="editor"></div>

        <button type="submit" class="btn btn-primary">Guardar</button>

    </form>


</body>
</html>
