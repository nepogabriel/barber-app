<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/css/clients/' . $template_client . '.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jsCalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>{{ $title }}</title>
</head>
<body class="bg-body">