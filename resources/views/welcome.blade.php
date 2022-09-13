<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Moohii - Test</title>

        <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('js/map.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            #map {
                height: 500px;
            }

            .is-invalid {
                background: #ff5722;
            }
        </style>

        <script>
            var actual_markers = <?php echo json_encode($actual_markers); ?>;
        </script>
        
    </head>
    <body>
        <div class="container px-4 py-4">
            <div class="container py-4" id="map"></div>
            <div class="container py-4">
                <h3 class="py-4"><b>Новий маркер</b></h3>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><b>{{ $error }}</b></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/add" method="POST">
                    @csrf
                    <label for="title">Широта</label>
 
                    <input name="lat" id="lat"
                        type="text"
                        class="py-4 px-4 bg-gray-100 @error('lat') is-invalid @enderror" required>

                    <label class="ml-4" for="title">Довгота</label>
 
                    <input name="lng" id="lng"
                        type="text"
                        class="py-4 px-4 bg-gray-100 @error('lng') is-invalid @enderror" required>

                    <button class="my-4 py-2 flex px-4 bg-green-200 text-gray-900 cursor-pointer hover:bg-blue-200 focus:text-blue-700 focus:bg-blue-200 focus:outline-none focus:ring-blue-600">
                        Додати
                    </button>
                </form>
            </div>
        </div>
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ $GM_KEY }}&callback=initMap&v=weekly"
            defer>
        </script>
        
    </body>
</html>
