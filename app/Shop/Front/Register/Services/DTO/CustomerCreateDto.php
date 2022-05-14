<?php

namespace App\Shop\Front\Register\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class CustomerCreateDto extends DataTransferObject
{
    /**
     * Customer first name
     *
     * @var string
     */
    public string $first_name;

    /**
     * Customer last name
     *
     * @var string
     */
    public string $last_name;

    /**
     * Customer email
     *
     * @var string
     */
    public string $email;

    /**
     * Customer phone
     *
     * @var string
     */
    public string $phone;

    /**
     * Customer password
     *
     * @var string
     */
    public string $password;
}