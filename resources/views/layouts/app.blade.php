<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
  <link rel="icon" href="{{ asset('assets/logo.svg') }}" type="image/svg+xml">
  @routes
  <script src="{{ mix('/js/app.js') }}" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  @inertiaHead
</head>

<body>
  @inertia
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>