<?php
namespace App\Shop\Admin\AdminsSettings\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\UploadedFile;

final class AdminUpdateDto extends DataTransferObject
{
    /**
     * Admin id
     *
     * @var int
     */
    public int $id;

    /**
     * Admin status
     *
     * @var null|string
     */
    public ?string $status;

    /**
     * Admin login
     *
     * @var string
     */
    public string $login;

    /**
     * Admin email
     *
     * @var string
     */
    public string $email;

    /**
     * Admin phone
     *
     * @var string
     */
    public string $telephone;

    /**
     * Admin avatar
     *
     * @var UploadedFile|string|null
     */
    public UploadedFile|string|null $avatar;

    /**
     * Admin newPwd
     *
     * @var null|string
     */
    public ?string $newPwd;

    /**
     * Admin confPwd
     *
     * @var null|string
     */
    public ?string $confirmPwd;

    /**
     * Admin permissions
     *
     * @var string
     */
    public string $permissions;
}