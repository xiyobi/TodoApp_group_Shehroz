<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

        html{
            height: 100%;
            margin: 0;
        }

        body {
            padding-top: 56px; /* Navbar balandligi */
        }
        .container-home {
            flex: 1;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: antiquewhite;
        }

        .navbar {
            border-bottom: 1px solid #ddd;
            background: blue;
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 50px 20px;
        }
        .hero-text {
            flex: 1;
            max-width: 600px;
        }
        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero-text p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #666;
        }
        .hero-image {
            flex: 1;
            text-align: center;
        }
        .hero-image img {
            max-width: 100%;
            border-radius: 8px;
        }
        .btn-primary-home {
            background-color: #ff5722;
            border: none;
        }
        .testimonials {
            background: #f7f7f7;
            padding: 40px 20px;
            text-align: center;
        }
        .testimonials .quote {
            font-style: italic;
            color: #555;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background: #f1f1f1;
        }

        .todo-body {
            max-width: 700px;
            box-shadow: 0 0 5px 5px #ccc;
            background-image: url("https://images.pexels.com/photos/2736499/pexels-photo-2736499.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1;");

        }

        .todo-text {
            font-weight: bold;
        }

        .completed {
            text-decoration: line-through;
            color: green;
        }

        .in_progress {
            text-decoration: underline;
            color: orange;
        }
        .home-body {
            background-color: #f8f9fa;
            background-image: url("https://images.pexels.com/photos/2736499/pexels-photo-2736499.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1;");

        }
        .edit-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .edit-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-actions {
            display: flex;
            justify-content: space-between;
        }
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
