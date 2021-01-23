@extends('layouts.SMS-APP')
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="body">
                    @include('includes.messages')
                    <!-- Place this code where you'd like the game to appear -->
                    <div class="miniclip-game-embed" data-game-name="quickfire-pool-instant" data-theme="5" data-width="100%" data-height="600" data-language="en"><a href="https://www.miniclip.com/games/quickfire-pool-instant/">Play Quick Fire Pool Instant</a></div>
                    <p style="text-align:center;">
                        <a href="https://www.miniclip.com/games/quickfire-pool-instant/" target="_blank">Play Quick Fire Pool Instant</a> -
                        <a href="https://www.miniclip.com/games/genre-1/" target="_blank">More Puzzle games</a> -
                        <a href="https://www.miniclip.com/terms" target="_blank">Terms and Conditions</a> -
                        <a href="https://www.miniclip.com/privacy" target="_blank">Privacy Policy</a>
                    </p>
                    
                    <!-- Insert this code before your </body> tag -->
                    <script src="//static.miniclipcdn.com/js/game-embed.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection