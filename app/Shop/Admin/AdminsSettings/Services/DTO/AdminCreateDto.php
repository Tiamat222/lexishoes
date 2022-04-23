<?php
namespace App\Shop\Admin\AdminsSettings\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\UploadedFile;

final class AdminCreateDto extends DataTransferObject
{
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
     * @var string
     */
    public string $newPwd;

    /**
     * Admin confPwd
     *
     * @var string
     */
    public string $confirmPwd;

    /**
     * Admin permissions
     *
     * @var string
     */
    public string $permissions;
}