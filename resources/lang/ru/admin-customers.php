<?php

return [
    'customer-firstName-required' => 'Поле "Имя" обязательно к заполнению.',
    'customer-lastName-required'  => 'Поле "Фамилия" обязательно к заполнению.',
    'customer-email-required'     => 'Поле "Email" обязательно к заполнению.',
    'customer-email-email'        => 'Вы ввели некорректный адрес электронной почты.',
    'customer-email-unique'       => 'Заказчик с таким email уже зарегистрирован. Укажите другой email.',
    'customer-phone-required'     => 'Поле "Тел." обязательно к заполнению.',
    'customer-phone-regex'        => 'Номер телефона (основной) должен соответствовать формату +38(999) 999-99-99.',
    'customer-phone-different'    => 'Основной и дополнительный номера телефонов должны отличаться.',
    'customer-phone-unique'       => 'Такой номер телефона (основной) уже зарегистрирован. Укажите другой.',
    'customer-dopPhone-regex'     => 'Номер телефона (дополнительный) должен соответствовать формату +38(999) 999-99-99.',
    'customer-dopPhone-unique'    => 'Такой номер телефона (дополнительный) уже зарегистрирован. Укажите другой.',
    'customer-store-success'      => 'Новый заказчик был успешно создан.',
    'customer-update-success'     => 'Данные заказчика были успешно обновлены.',
    'customer-delete-success'     => 'Заказчик был успешно перемещен в корзину.',
    'customer-destroy-success'    => 'Заказчик был успешно удален (безвозвратно).',
    'customer-restore-success'    => 'Заказчик был успешно восстановлен.',
    'customer-password-required'  => 'Поле "Пароль" обязательно к заполнению',
    'customer-password-min'       => 'Минимальная длина пароля - ' . get_setting('pwd_length') . ' символов',
    'customer-report'             => 'Отчет по заказчику ',
    'customer-email-success'      => 'Письмо было отправлено заказчику',
];