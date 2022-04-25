<?php
namespace App\Shop\Admin\Customers\Services\DTO;

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
     * Customer dop phone
     *
     * @var null|string
     */
    public ?string $dop_phone;

    /**
     * Customer adress
     *
     * @var string|null
     */
    public ?string $address;

    /**
     * Customer comment
     *
     * @var string|null
     */
    public ?string $comment;

    /**
     * Customer password
     *
     * @var string
     */
    public string $password;
}