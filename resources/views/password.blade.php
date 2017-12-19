<div class="loginbox">
        <form role="form" method="POST" action="/home/{{Auth::user()->username}}/altPassword">

            {{ csrf_field() }}
            <label>
            <b>Password Atual</b>
            </label>
            <input type="password" placeholder="Password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span>
                <strong>{{ $errors->first('password') }}</strong>
                <br>
            </span>
            @endif

            <label>
            <b>Nova Password</b>
            </label>
            <input type="password" placeholder="Nova Password" class="form-control" id="new_password" name="new_password" required>
            @if ($errors->has('password'))
            <span>
                <strong>{{ $errors->first('password') }}</strong>
                <br>
            </span>
            @endif

            <label>
                <b>Confirme a Nova Password</b>
            </label>
            <input id="password-confirm" type="password" placeholder="Nova Password" class="form-control" name="password_confirmation" required>
            <span><a id="forgot" href="{{ url('/password/reset') }}">Forgot your Password?</a></span>

        <button type="submit" id="lbutton">Alterar Password</button>

        </form>
</div>