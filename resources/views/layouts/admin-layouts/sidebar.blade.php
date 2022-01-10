<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Name</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-list-alt"></i>
              <p>
                Каталог
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Товары</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" title="Категории">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Категории</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" title="Поставщики">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Поставщики</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Характеристики товаров</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Скидки</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Комбинации товаров</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Настройки
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link" title="Общие настройки">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Общие настройки</p>
                </a>
              </li>
              @permission('information')
              <li class="nav-item">
                <a href="{{ route('admin.settings.information') }}" class="nav-link" title="Информация">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Информация</p>
                </a>
              </li>
              @endpermission
              @permission('log')
              <li class="nav-item">
                <a href="{{ route('admin.settings.log.index') }}" class="nav-link" title="Логи магазина">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Логи магазина</p>
                </a>
              </li>
              @endpermission
              @permission('settings')
              <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link" title="Настройки сайта">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Настройки магазина</p>
                </a>
              </li>
              @endpermission
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>