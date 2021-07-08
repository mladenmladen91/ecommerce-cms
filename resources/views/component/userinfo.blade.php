<!--<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $username  }}</span>
    <img class="img-profile rounded-circle" src="https://via.placeholder.com/32x32.png?text={{ Str::limit($username, 1) }}">
</a>-->
<a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
{{--    <a class="dropdown-item" href="#">--}}
{{--        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--        Profile--}}
{{--    </a>--}}
{{--    <a class="dropdown-item" href="#">--}}
{{--        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--        Settings--}}
{{--    </a>--}}
{{--    <a class="dropdown-item" href="#">--}}
{{--        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--        Activity Log--}}
{{--    </a>--}}
    <div class="dropdown-divider"></div>
    
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Da li ste spremni da zavrsite?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Izaberite "Izadji" ako ste spremni da zavrsite trenutno sesiju.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Izadji</a>
            </div>
        </div>
    </div>
</div>