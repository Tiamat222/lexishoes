<?php
namespace App\Shop\Admin\AdminProfile\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ChangePasswordDto extends DataTransferObject
{    
    /**
     * Admin id
     *
     * @var int
     */
    public int $id;

    /**
     * New password
     *
     * @var string
     */
    public string $newPwd;

    /**
     * Confirmation password
     *
     * @var string
     */
    public string $confirmPwd;
}