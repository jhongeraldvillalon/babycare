<?php

class Account extends Model
{
    protected $table = 'users';
    protected $allowedColumns = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'contact',
    ];

    public function validate($DATA, $currentUserId = null)
    {
        $this->errors = [];

        if (isset($DATA['first_name'])) {
            if (empty($DATA['first_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['first_name'])) {
                $this->errors['first_name'] = 'First Name: Only letters are allowed in this field and no leading or trailing spaces';
            }
        }

        if (isset($DATA['middle_name'])) {
            if (!empty($DATA['middle_name']) && !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['middle_name'])) {
                $this->errors['middle_name'] = 'Middle Name: Only letters are allowed in this field and no leading or trailing spaces';
            }
        }
        if (isset($DATA['last_name'])) {
            if (empty($DATA['last_name']) || !preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $DATA['last_name'])) {
                $this->errors['last_name'] = 'Last Name: Only letters are allowed in this field and no leading or trailing spaces';
            }
        }
        if (isset($DATA['email'])) {
            $currentEmail = null;
            if ($currentUserId) {
                $currentUser = $this->first('id', $currentUserId);
                $currentEmail = $currentUser ? $currentUser->email : null;
            }

            if ($currentEmail !== $DATA['email']) {
                $existingUser = $this->where('email', $DATA['email']);
                if ($existingUser && $existingUser->id != $currentUserId) {
                    $this->errors['email'] = 'This email is already in use by another account. Please use a different email.';
                }
            }
        }

        if (isset($DATA['gender'])) {
            $genders = ['female', 'male'];

            if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
                $this->errors['gender'] = 'Gender is not valid';
            }
        }

        if (isset($DATA['contact'])) {
            if (empty($DATA['contact']) || !preg_match("/^\d+$/", $DATA['contact'])) {
                $this->errors['contact'] = 'Contact Number: Please use a proper contact number.';
            }
        }
        return count($this->errors) === 0;
    }

    public function updateUserInfo($id, $data)
    {
        // Update user information except password
        $updateData = [
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'contact' => $data['contact'],
            // Add other fields as needed
        ];

        $this->update($id, $updateData);
    }
}
