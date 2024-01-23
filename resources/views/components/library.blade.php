<head>
    <meta charset="UTF-8">
    {{-- Title Section --}}
	<title>Nikko Brewing</title>

    {{-- Logo Section --}}
    <link rel="icon" href="{{ url('images\logo.ico') }}">

    {{-- Page Utility Section --}}
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta itemprop="name" content="Nikko Brewing">
	<meta itemprop="description" content="Nikko Brewing, Opened in April 2018 by Sanbonmatsu Chaya, a long-established souvenir shop located in Senjogahara!">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >
	<meta http-equiv="Pragma" content="no-cache" /><meta http-equiv="Expires" content="-1" />
	<meta http-equiv="Cache-Control" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="keywords" content="Nikko Brewing, Nikko, Brewing, Beer, Nikko Park, Sanbonmatsu Chaya, Sanbonmatsu, Souvenir Shop, Shouvenir, Shop, Senjogahara" />
	<meta name="description" content="Nikko Brewing, Opened in April 2018 by Sanbonmatsu Chaya, a long-established souvenir shop located in Senjogahara!" />
	<meta name="author" property="author" content="Nikko" />
    <meta http-equiv="content-language" content="en">

    {{-- Stylesheet Import Section --}}
    <link rel="stylesheet" href="{{ url('css/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="{{ url('css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('css/util.css') }}">

    {{-- JavaScript Import Section --}}
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="{{ url('js/main.js') }}"></script>

</head>
