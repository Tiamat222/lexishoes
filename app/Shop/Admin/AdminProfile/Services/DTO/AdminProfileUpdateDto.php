<?php
namespace App\Shop\Admin\AdminProfile\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\UploadedFile;

class AdminProfileUpdateDto extends DataTransferObject
{    
    /**
     * Admin id
     *
     * @var int
     */
    public int $id;

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
     * Admin telephone
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
}