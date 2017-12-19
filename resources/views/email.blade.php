<div class="loginbox">
        <form role="form" method="POST" action="/home/{{Auth::user()->username}}/altEmail">

            {{ csrf_field() }}

            <label>
            <b>E-Mail Address</b>
            </label>
            <input type="text" placeholder="email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span>
                <strong>{{ $errors->first('email') }}</strong>
                <br>
            </span>
            @endif
                
            <button type="submit" id="lbutton">Alterar Email</button>

        </form>
</div>