
    <div class="sidebar-menu mt-4">
        <ul class="menu">
            <li class="sidebar-item activ">
                <a href="/dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>User Management</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ route('apoteker.tabel') }}" class="submenu-link">Apoteker</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('kasir.tabel') }}" class="submenu-link">Kasir</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('gudang.tabel') }}" class="submenu-link">Gudang</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('inventory.tabel') }}" class='sidebar-link'>
                    <i class="bi bi-gear-fill"></i>
                    <span>Inventory Obat</span>
                </a>
            </li>
        </ul>
    </div>

