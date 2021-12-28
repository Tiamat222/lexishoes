<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

// Home > Information
Breadcrumbs::for('information', function ($trail) {
    $trail->parent('home');
    $trail->push('Информация', route('admin.settings.information'));
});