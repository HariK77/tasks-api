<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="container p-5">
        <h1 class="text-center">
            Welcome to Lucky 7 Game
        </h1>
        <div>
            <h2>Place Your Bet (Rs: 10)</h2>
            <a class="btn btn-primary" href="{{ route('home', ['selection'=>'below7']) }}">[Below 7]</a>
            <a class="btn btn-primary" href="{{ route('home', ['selection'=>'seven']) }}">[7]</a>
            <a class="btn btn-primary" href="{{ route('home', ['selection'=>'above7']) }}">[Above 7]</a>
            <a class="btn btn-primary"
                href="{{ route('home', ['play'=>'play', 'selection' => request()->get('selection')]) }}">[Play]</a>
        </div>
        <div class="pt-4">
            <h2>Game Results</h2>
            <p>Dice 1: {{ isset($dOne) ? $dOne : '0' }}</p>
            <p>Dice 2: {{ isset($dTwo) ? $dTwo : '0' }}</p>
            <hr>
            <p>Total: {{ isset($total) ? $total : '0'}}</p>
        </div>
        <div class="pb-4">
            @if (request()->has('play') && request()->has('selection'))
            @if(isset($oldAmount) && isset($newAmount) && ($oldAMount < $newAmount)) Congratulations! You Win! Your
                balance is now {{ $newAmount }} Rs. @else Sorry! You Lose! Your balance is now {{ $currentAmount }} Rs.
                @endif @endif </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('home', ['selection'=>'below7']) }}">[Reset and Play
                        Again]</a>
                    <a class="btn btn-primary" href="{{ route('home', ['continue'=>'continue']) }}">[Continue
                        Playing]</a>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>