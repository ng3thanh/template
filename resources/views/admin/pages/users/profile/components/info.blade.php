<div class="tab-pane" id="information-tab">
    <form id="information" class="form-horizontal" method="post" action="{{ route('user.update.profile') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" id="inputFirstName" value="{{ $loggedUser->first_name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" id="inputLastName" value="{{ $loggedUser->last_name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" value="{{ $loggedUser->email }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <textarea name="address" class="form-control" id="inputAddress">{{ $loggedUser->address }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input name="phone" type="text" class="form-control" id="inputPhone" value="{{ $loggedUser->phone }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputBirthday" class="col-sm-2 control-label">Birthday</label>
            <div class="col-sm-10">
                <input name="birthday" type="text" class="form-control" id="inputBirthday" value="{{ $loggedUser->birthday }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" form="information" class="btn btn-danger">Submit</button>
            </div>
        </div>
    </form>
</div>