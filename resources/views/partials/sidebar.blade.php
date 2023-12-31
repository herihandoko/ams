<!-- begin #sidebar -->
<div id="sidebar" class="sidebar {{ ConfigsHelper::getByKey('sidebar_styling')=='grid'?'sidebar-grid':'' }} {{ ConfigsHelper::getByKey('sidebar_transparent')== 1?'sidebar-transparent':'' }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img id="img-sidebar-avatar" src="{{ Auth::user()->avatar=='avatar.png'? asset('assets/img/'. Auth::user()->avatar) : url('files/profile/'. Auth::user()->avatar) }}" alt="Avatar" /></a>
                </div>
                <div class="info">
                    {{ Auth::user()->name }}
                    <small>{{ Auth::user()->job_title }}</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            @each('partials.sidebar.menu-item', MenuHelper::print_menu('sidebar'), 'item')
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->