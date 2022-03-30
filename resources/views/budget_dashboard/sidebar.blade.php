<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('budget.index') }}" aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">EMF Lists</span>
                    </a>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('budget.saa') }}" aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">Encode SAA</span>
                    </a>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('budget.dsaa') }}" aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">Download SAA</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>