<?php

class Users extends Controller
{
    public function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect("login");
        }

        $user = new User();
        $limit = 9;
        $pager = new Pager($limit);
        $offset = $pager->offset;


        $query = "select * from users where user_role != 'parent' and (approve = '1' OR user_role = 'admin') order by id desc limit $limit offset $offset";
        $arr = [];
        if (isset($_GET['find'])) {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where user_role != 'parent' and (approve = '1' OR user_role = 'admin') && (first_name like :find || middle_name like :find || last_name like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query($query, $arr);


        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('users', [
            'rows' => $data,
            'pager' => $pager
        ]);
        echo $this->view('includes/footer');
    }
}
