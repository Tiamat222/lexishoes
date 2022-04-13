<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    @if(isset($storeLogo))
    <img src="{{ asset($storeLogo) }}" class="brand-image img-circle elevation-3" style="opacity: .8">
    @endif
    <span class="brand-text font-weight-light">{{($storeTitle) ? $storeTitle : ''}}</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <a href="{{ route('admin.settings.profile.edit') }}">
          @if(auth()->guard('admins')->user()->avatar !== '' && auth()->guard('admins')->user()->avatar !== null)
            <img class="img-circle elevation-2" src="{{ asset(auth()->guard('admins')->user()->avatar) }}"/>
          @else
            <img class="img-circle elevation-2" src="{{ asset('storage/images/default-images/default-avatar.png') }}"/>
          @endif
        </a>
      </div>
      <div class="info">
        <a href="{{ route('admin.settings.profile.edit') }}" class="d-block">{{ auth()->guard('admins')->user()->login }}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"><i class="nav-icon fa fa-list-alt"></i><p>Каталог<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            @permission('products')
            <li class="nav-item">
              <a href="{{ route('admin.catalog.products.index') }}" class="nav-link" title="Товары"><i class="far fa-circle nav-icon"></i><p>Товары</p></a>
            </li>
            @endpermission
            @permission('categories')
            <li class="nav-item">
              <a href="{{ route('admin.catalog.categories.index') }}" class="nav-link" title="Категории"><i class="far fa-circle nav-icon"></i><p>Категории</p></a>
            </li>
            @endpermission
            @permission('suppliers')
            <li class="nav-item">
              <a href="{{ route('admin.catalog.suppliers.index') }}" class="nav-link" title="Поставщики"><i class="far fa-circle nav-icon"></i><p>Поставщики</p></a>
            </li>
            @endpermission
            @permission('attributes')
            <li class="nav-item">
              <a href="{{ route('admin.catalog.attributes.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Атрибуты товаров</p></a>
            </li>
            @endpermission
            <li class="nav-item">
              <a href="pages/layout/fixed-sidebar.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Скидки</p></a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/fixed-topnav.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Комбинации товаров</p></a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"><i class="nav-icon fa fa-cogs"></i><p>Настройки<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            @permission('information')
            <li class="nav-item">
              <a href="{{ route('admin.settings.information') }}" class="nav-link" title="Информация"><i class="far fa-circle nav-icon"></i><p>Информация</p></a>
            </li>
            @endpermission
            @permission('log')
            <li class="nav-item">
              <a href="{{ route('admin.settings.log.index') }}" class="nav-link" title="Логи магазина"><i class="far fa-circle nav-icon"></i><p>Логи магазина</p></a>
            </li>
            @endpermission
            @permission('settings')
            <li class="nav-item">
              <a href="{{ route('admin.settings.index') }}" class="nav-link" title="Настройки сайта"><i class="far fa-circle nav-icon"></i><p>Настройки магазина</p></a>
            </li>
            @endpermission
            @permission('export')
            <li class="nav-item">
              <a href="{{ route('admin.settings.export.index') }}" class="nav-link" title="Экспорт"><i class="far fa-circle nav-icon"></i><p>Экспорт</p></a>
            </li>
            @endpermission
            @permission('import')
            <li class="nav-item">
              <a href="{{ route('admin.settings.import.index') }}" class="nav-link" title="Импорт"><i class="far fa-circle nav-icon"></i><p>Импорт</p></a>
            </li>
            @endpermission
          </ul>
        </li>
        @permission('customers')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Заказчики<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.customers.index') }}" class="nav-link" title="Заказчики"><i class="far fa-circle nav-icon"></i><p>Заказчики</p></a>
            </li>
          </ul>
        </li>
        @endpermission
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link"><i class="nav-icon far fa-envelope"></i><p>Mailbox<i class="fas fa-angle-left right"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Inbox</p></a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Compose</p></a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Read</p></a>
              </li>
            </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>