{!! Menu::display('admin') !!}<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>


<li class="{{ Request::is('experts*') ? 'active' : '' }}">
    <a href="{!! route('experts.index') !!}"><i class="fa fa-edit"></i><span>Experts</span></a>
</li>

<li class="{{ Request::is('teachers*') ? 'active' : '' }}">
    <a href="{!! route('teachers.index') !!}"><i class="fa fa-edit"></i><span>Teachers</span></a>
</li>

<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('banners.index') !!}"><i class="fa fa-edit"></i><span>Banner</span></a>
</li>

<li class="{{ Request::is('bannerItems*') ? 'active' : '' }}">
    <a href="{!! route('bannerItems.index') !!}"><i class="fa fa-edit"></i><span>BannerItems</span></a>
</li>

