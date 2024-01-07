<?php

class Password extends Model
{
    protected $table = 'users';
    protected $allowedColumns = [
        'password',

    ];


    public function validateForPasswordUpdate($DATA, $currentUserId)
    {
        // Add validation logic specific to password update
        $this->errors = [];

        if (empty($DATA['password']) || $DATA['password'] != $DATA['password2']) {
            $this->errors['password'] = 'Password do not match';
        }

        if (strlen($DATA['password']) < 8) {
            $this->errors['password'] = 'Password length must be at least 8 characters';
        }

        return count($this->errors) === 0;
    }

    public function updatePassword($id, $password)
    {
        // Update user password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $updateData = [
            'password' => $passwordHash,
        ];

        $this->update($id, $updateData);
    }
}
