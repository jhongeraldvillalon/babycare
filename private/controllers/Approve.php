<?php

class Approve extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }
        $approve = new Approved();

        $limit = 5;
        $pager = new Pager($limit);
        $offset =   $pager->offset;

        $query = "select * from users where approve not in ('1') and user_role not in ('admin') order by id desc limit $limit offset $offset";
        $arr = [];

        if (isset($_GET['find'])) {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where approve not in ('1') and user_role not in ('admin') && (first_name like :find || middle_name like :find || last_name like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $approve->query($query, $arr);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('approve', [
            'rows' => $data,
            'pager' => $pager
        ]);
        echo $this->view('includes/footer');
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];
        $approve = new Approved();

        if (count($_POST) > 0) {


            if ($approve->validate($_POST)) {

                $approve->update($id, $_POST);
                $user = $approve->where('id', $id);

                $user_email = $user[0]->email;

                $subject = 'Account Approval';
                $body = 'Congratulations! Your account has been approved. You can now access your BabyCare account. <br> You can login on this link ' . LOGIN . ' .';

                // Sending email notification
                EmailService::sendMail($user_email, $subject, $body);


                $this->redirect('approve');
            } else {
                $errors = $approve->errors;
            }
        }

        $row = $approve->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'approve.edit',
            [
                'row' => $row,
                'errors' => $errors,

            ]
        );
        echo $this->view('includes/footer');
    }

    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        if (!Auth::isAdmin() && !Auth::isParent()) {
            $this->redirect("home");
        }

        $errors = [];
        $approve = new Approved();

        if (count($_POST) > 0) {
            $approve->delete($id);
            $this->redirect('approve');
        }

        $row = $approve->where('id', $id);

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view(
            'approve.delete',
            [
                'row' => $row,
            ]
        );
        echo $this->view('includes/footer');
    }
}
