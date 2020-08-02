<div class="wrapper">
    <?if($isError == true):?>
    <div class="messageBox">
        Incorrect data
    </div>
    <?endif;?>
    <form id="loginForm" method="POST" action="/user/login">
        <div>
            <label for="username">username</label>
            <input id="itUsername" name="username" type="text" />
        </div>
        <div>
            <label for="password">password</label>
            <input id="itPassword" name="password" type="password" />
        </div>
        <div>
            <input type="submit" value="login" />
        </div>
    </form>
</div>
<script src="../../src/Assets/scripts/validate.js" ></script>