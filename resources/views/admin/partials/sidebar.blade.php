<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('all.category') }}">
                                <span data-key="t-calendar">All Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('add.category') }}">
                                <span data-key="t-chat">Add Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.all.product') }}">
                                <span data-key="t-calendar">All Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.add.product') }}">
                                <span data-key="t-chat">Add Product</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage City</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('all.city') }}">
                                <span data-key="t-calendar">All City</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage Restaurant</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pending.restaurant') }}">
                                <span data-key="t-calendar">Pending Restaurant </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('approve.restaurant') }}">
                                <span data-key="t-chat">Approve Restaurant</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage Banner</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('all.banner') }}">
                                <span data-key="t-calendar">All Banner </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Manage Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pending.order') }}">
                                <span data-key="t-calendar">Pending Orders </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('confirm.order') }}">
                                <span data-key="t-calendar">Confirm Orders </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('processing.order') }}">
                                <span data-key="t-calendar">Processing Orders </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('delivered.order') }}">
                                <span data-key="t-calendar">Delivered Orders </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-components">Manage Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.all.reports') }}" data-key="t-alerts">All Reports</a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
