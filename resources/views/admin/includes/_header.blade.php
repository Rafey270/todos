<header>
    <!-- headerwrapper -->
    <div class="headerwrapper">
        <!-- header-left -->
        <div class="header-left">
            <a href="/admin" class="logo">
                <img src="/images/logo.png" alt="" />
            </a>
            <div class="pull-right">
                <a href="#" class="menu-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>

        <!-- header-right -->
        <div class="header-right">

            <div class="pull-right">

                <div class="btn-group btn-group-option">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="glyphicon glyphicon-log-out"></i>Sign Out
                            </a>
                        </li>
                    </ul>
                        <form id="logoutform" action="{{ url('logoutUser') }}" method="POST" style="display: none;">
                             {{ csrf_field() }}
                        </form>
                </div><!-- btn-group -->

            </div><!-- pull-right -->

        </div><!-- header-right -->

    </div>
</header>
