
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Blog Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&family=Roboto+Mono:wght@200;400;500;700&family=Rubik:wght@300;400;500;600;700&family=Varela+Round&display=swap');

        .font-family-karla {
            font-family: 'Rubik', sans-serif;  
        }
    </style>

    <!-- AlpineJS -->
    @yield('logincontent')

    

</body>
</html>