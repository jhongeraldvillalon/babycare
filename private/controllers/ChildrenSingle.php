<?php

class ChildrenSingle extends Controller
{
    public function index($id = '')
    {
        $children = new Child();

        $row = $children->first('child_id', $id);

        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'staff';

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('childrensingle', [
            'row' => $row,
            'page_tab' => $page_tab,
        ]);
        echo $this->view('includes/footer');
    }
}
