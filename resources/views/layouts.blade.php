<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @yield("head")
</head>
<style>
    #content-wrapper{
        background-color: bisque;
        padding: 5px;
        margin: 20px;
        border-radius: 20px;
    }

    #content-header{
        background-color: rgba(242, 190, 126, 1);
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px; 
        margin-bottom: 20px;
    }

    #content-footer{
        background-color: rgba(218, 175, 121, 1);
        padding: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #back-messages{
        border-radius: 5px;
    }

    #content-general{
        display: flex;
        flex-direction: column;
        padding: 20px;
        margin: 20px;
        border-radius: 15px;
        background-color: rgb(251, 212, 164);
    }

    #content-main{
        padding: 20px;
    }
</style>
<body style="background-image: url('/imgs/tad-icon.png'); background-size: contain;">   
    <x-application-navbar>
    </x-application-navbar>
    
    <div class="container">
        <div id="content-wrapper">
            <div id="content-general">
                <header id="content-header">
                    @yield("content_header")
                </header>

                <div id="back-messages">
                    @yield("content_messages")
                </div>
                <div id="content-main">
                    @yield("content")
                </div>
            </div>
        </div>

        <footer class="text-center">
            <h6>Copyright © 2023 - TAD. All rights reserved.</h6>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    @yield("scripts")
</body>
</html>