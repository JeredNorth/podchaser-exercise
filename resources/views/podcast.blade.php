<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Podchaser exercise</title>
</head>

<style>
    body {
        background-color: #444;
        color: white;
    }

    .header {
        text-align: center;
    }

    .podcast-list-item{
        margin-bottom: 5px;
        font-size: 20px;
    }
    
</style>


<body>
    <h1 class="header">Podcast Information!</h1>

    <h1>Podcast Info</h1>
    <ul>
        {{-- @foreach ($podcastInfo as $podcast) --}}
        <li class="podcast-list-item">{{ $podcast['title'] }}</li>
        <li class="podcast-list-item">{{isset($podcast['image']['url']) ? $podcast['image']['url'] : "empty"}}
        {{-- <li class="podcast-list-item">{{ $podcast['image']['url'] }}</li> --}}
        <li class="podcast-list-item">{{ $podcast['description'] }}</li>
        <li class="podcast-list-item">{{ $podcast['language'] }}</li>
        <li class="podcast-list-item">{{ $podcast['link'] }}</li>

        {{-- @endforeach --}}
    </ul>

    <h1>Episode Info</h1>
    <ul>
        @foreach ($episodes as $episode)
        <li class="podcast-list-item">{{ $episode['title'] }}</li>
        <ul>
            {{-- <li class="affiliate-list-item">{{ $episode['link'] }}</li> --}}
            <li class="podcast-list-item">{{isset($episode['link']) ? $episode['link'] : "empty"}}</li>
            <li class="podcast-list-item">{{ $episode['enclosure']['@attributes']['url'] }}</li>
            <li class="podcast-list-item">
                {{!empty($episode['description']) ? $episode['description'] : "empty"}}
            </li>
        </ul>
        @endforeach
    </ul>

</body>
</html>