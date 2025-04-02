<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <script src= "https://code.jquery.com/jquery-3.1.1.min.js"crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        body{
            overflow-y: hidden;
        }
    </style>
</head>
<body>
    
    <div id="login" style="padding-top: 12%;">
            <div class="ui placeholder segment" style="margin-left:28%;width: 40%;height:50%;">
            <div class="ui two column very relaxed stackable grid" style="padding-top: 15%;">
                <div class="column">
                <form class="ui form" method="post">
                    <div class="field">
                    <label>Username</label>
                    <div class="ui left icon input">
                        <input type="text" placeholder="Username" name="logemail">
                        <i class="user icon"></i>
                    </div>
                    <h5 style="color: red;">
                                        </h5>
                    </div>
                    <div class="field">
                    <label>Password</label>
                    <div class="ui left icon input">
                        <input type="password" placeholder="Password" name="logpassword">
                        <i class="lock icon"></i>
                    </div>
                    <h5 style="color: red;">
                                        </h5>
                    </div>
                    <a href="./php/transaction.php" class="ui blue submit button" name="login">Login</a>
                </form>
                
                </div>
                <div class="middle aligned column" >
                <div class="ui big button" onclick="modal()">
                    <i class="signup icon"></i>
                    Sign Up
                </div>

                </div>
                
                
                
                
            </div>
            <div class="ui sixteen wide column right aligned container" >
                <h4 style="padding-right: 10%;">Powered By</h4>
                <img src="./sources/bits.png" alt="" width="25%" height="15%" >
                </div>
                <div class="ui vertical divider">
                Or
            </div>
            </div>
            
    </div>

        
        


    <script>
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
        $('select.dropdown').dropdown();
        function modal(){
            $('.ui.modal').modal('show');
        }
    </script>
</body>
</html>