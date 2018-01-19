<html>
    <head>
        <title>My Login Page</title>
    </head>
    <body>
        <h1>Login</h1>

        <form action="ssologin" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-6">
                    <input type="text" name="email" id="email" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-6">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>

            <input type="submit" value="Submit"/>
        </form>

        <button onclick="location.href = '{{ url('/') }}/oauth/google';">Login w/ Google</button>
    </body>
</html>
