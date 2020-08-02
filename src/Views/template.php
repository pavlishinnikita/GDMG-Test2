<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/Assets/style/style.css" />
    <title>Auth app</title>
</head>
<body>
    <header class="header">
        <nav>
            <ul class="main-menu">
                <li><a href="/">HOME</a></li>
                <li><a href="/user/">TO PROFILE</a></li>
                <li><a href="/user/login/">TO LOGIN</a></li>
                <!--li><a href="/user/register/">TO REGISTER</a></li-->
            </ul>
        </nav>
    </header>
    <main>
        <?=$content?>
    </main>
    <footer>
        <div class="text">Developed by Pavlishin Mykyta 
            <time><?=date("Y")?></time>
        </div>
    </footer>
</body>
</html>