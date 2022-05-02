<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

// Home > Information
Breadcrumbs::for('information', function ($trail) {
    $trail->parent('home');
    $trail->push('Информация');
});

// Home > Log
Breadcrumbs::for('log', function ($trail) {
    $trail->parent('home');
    $trail->push('Логи');
});

// Home > Suppliers
Breadcrumbs::for('suppliers', function ($trail) {
    $trail->parent('home');
    $trail->push('Поставщики', route('admin.catalog.suppliers.index'));
});

// Home > Suppliers > Add supplier
Breadcrumbs::for('add-supplier', function ($trail) {
    $trail->parent('suppliers');
    $trail->push('Добавить нового поставщика');
});

// Home > Suppliers > Show supplier
Breadcrumbs::for('show-supplier', function ($trail) {
    $trail->parent('suppliers');
    $trail->push('Просмотр поставщика');
});

// Home > Suppliers > Suppliers in trash
Breadcrumbs::for('trash-suppliers', function ($trail) {
    $trail->parent('suppliers');
    $trail->push('Корзина');
}); 

// Home > General settings
Breadcrumbs::for('general-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Настройки магазина');
});

// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push('Список категорий', route('admin.catalog.categories.index'));
});

// Home > Categories > New category
Breadcrumbs::for('create-category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Добавить категорию');
});

// Home > Categories > New category
Breadcrumbs::for('trash-categories', function ($trail) {
    $trail->parent('categories');
    $trail->push('Корзина');
});

// Home > Categories > Show
Breadcrumbs::for('show-category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Просмотр категории');
});

// Home > Categories > Edit
Breadcrumbs::for('edit-category', function ($trail) {
    $trail->parent('categories');
    $trail->push('Редактирование категории');
});

// Home > Export
Breadcrumbs::for('export', function ($trail) {
    $trail->parent('home');
    $trail->push('Экспорт');
});

// Home > Export
Breadcrumbs::for('import', function ($trail) {
    $trail->parent('home');
    $trail->push('Импорт');
});

// Home > Attributes
Breadcrumbs::for('attributes', function ($trail) {
    $trail->parent('home');
    $trail->push('Атрибуты товаров', route('admin.catalog.attributes.index'));
});

// Home > Attributes > New attribute
Breadcrumbs::for('create-attribute', function ($trail) {
    $trail->parent('attributes');
    $trail->push('Новый атрибут');
});

// Home > Attributes > Create attribute value
Breadcrumbs::for('create-attribute-value', function ($trail) {
    $trail->parent('attributes');
    $trail->push('Новое значение');
});

// Home > Attributes > Edit attribute
Breadcrumbs::for('edit-attribute', function ($trail) {
    $trail->parent('attributes');
    $trail->push('Редактирование атрибута');
});

// Home > Attributes > Attribute values
Breadcrumbs::for('attribute-values', function ($trail) {
    $trail->parent('attributes');
    $trail->push('Значения атрибута');
});

// Home > Attributes > Edit attribute value
Breadcrumbs::for('edit-attribute-value', function ($trail) {
    $trail->parent('attributes');
    $trail->push('Редактирование значения атрибута');
});

// Home > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('home');
    $trail->push('Список товаров', route('admin.catalog.products.index'));
});

// Home > Create product
Breadcrumbs::for('create-product', function ($trail) {
    $trail->parent('products');
    $trail->push('Новый товар');
});

// Home > Admin profile
Breadcrumbs::for('admin-profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Профиль');
});

// Home > Customers
Breadcrumbs::for('customers', function ($trail) {
    $trail->parent('home');
    $trail->push('Список заказчиков', route('admin.customers.index'));
});

// Home > Customers > Create Customer
Breadcrumbs::for('create-customer', function ($trail) {
    $trail->parent('customers');
    $trail->push('Добавить заказчика');
});

// Home > Customers > Edit Customer
Breadcrumbs::for('edit-customer', function ($trail) {
    $trail->parent('customers');
    $trail->push('Редактирование заказчика');
});

// Home > Customers > Trash
Breadcrumbs::for('trash-customers', function ($trail) {
    $trail->parent('customers');
    $trail->push('Корзина');
});

// Home > Customers > Show
Breadcrumbs::for('show-customer', function ($trail) {
    $trail->parent('customers');
    $trail->push('Детали заказчика');
});

// Home > Admins
Breadcrumbs::for('admins', function ($trail) {
    $trail->parent('home');
    $trail->push('Список администраторов', route('admin.settings.admins.index'));
});

// Home > Admins > Activity
Breadcrumbs::for('activity', function ($trail) {
    $trail->parent('admins');
    $trail->push('Активность на сайте');
});

// Home > Admins > Create Admin
Breadcrumbs::for('create-admin', function ($trail) {
    $trail->parent('admins');
    $trail->push('Новый администратор');
});

// Home > Admins > Edit Admin
Breadcrumbs::for('edit-admin', function ($trail) {
    $trail->parent('admins');
    $trail->push('Редактирование администратора');
});

// Home > Admins > Trash
Breadcrumbs::for('trash-admins', function ($trail) {
    $trail->parent('admins');
    $trail->push('Корзина');
});

// Home > Orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push('Список заказов', route('admin.orders.index'));
});

// Home > Orders > Details
Breadcrumbs::for('order-details', function ($trail) {
    $trail->parent('orders');
    $trail->push('Детали заказа');
});

// Home > Pages
Breadcrumbs::for('pages', function ($trail) {
    $trail->parent('home');
    $trail->push('Список страниц', route('admin.catalog.pages.index'));
});

// Home > Pages > New Page
Breadcrumbs::for('new-page', function ($trail) {
    $trail->parent('pages');
    $trail->push('Новая страница');
});