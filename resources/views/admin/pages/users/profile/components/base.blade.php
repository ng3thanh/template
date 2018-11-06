<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src='{{ asset(getAvatarUser("$loggedUser->avatar")) }}' alt="User profile picture">

        <h3 class="profile-username text-center">{{ $loggedUser->first_name . ' ' . $loggedUser->last_name }}</h3>

        <p class="text-muted text-center">Software Engineer</p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Followers</b> <a class="pull-right">1,322</a>
            </li>
            <li class="list-group-item">
                <b>Following</b> <a class="pull-right">543</a>
            </li>
            <li class="list-group-item">
                <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
    </div>
</div>