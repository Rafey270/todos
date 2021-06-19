<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" href="#">
            <img class="img-circle" src="/images/photos/user1.png" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">User</h4>
            <small class="text-muted">User</small>
        </div>
    </div><!-- media -->

    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li class="{{ Route::is('/home') ? 'active' : '' }}">
            <a href="/home">
            <i class="fa fa-home"></i>
            <span>Dashboard</span></a>
        </li>


        <li class="{{ Route::is('todos') ? 'active' : '' }}">
            <a href="/todos">
            <i class="fa fa-users"></i>
            <span>Todos</span></a>
        </li>
    </ul>

</div><!-- leftpanel -->
