<!DOCTYPE html>
<html>
    <head>
        <title><?=$title ?></title>
            <style>
                h1 {font-size: 48pt;
                    margin: 0px 0px 10px 0px;
                    padding: 0px 20px;
                    color: white;
                    background: linear-gradient(to right, #aaa, #fff);}
                p {font-size: 14px; color: #666;}
            </style>
    </head>

    <body>
        <header class="row">
            <h1><?=$title ?></h1>
        </header>
        <div class="row">
            <table>
                <form method="post" action="/mycakeapp/hello/form">
                <tr><th>name</th><td>
                    <input type="text" name="name"></td></tr>
                <tr><th>mail</th><td>
                    <input type="text" name="mail"></td></tr>
                <tr><th>age</th><td>
                    <input type="number" name="age"></td></tr>
                <tr><th></th><td><button>
                    Click</button></td></tr>
                </form>
            </table>
        </div>
    </body>
</html>
