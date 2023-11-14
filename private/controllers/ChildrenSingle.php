<?php

class ChildrenSingle extends Controller
{
    public function index($id = '')
    {
        $children = new Child();

        $row = $children->first('child_id', $id); 

        echo $this->view('includes/header');
        echo $this->view('includes/nav');
        echo $this->view('childrensingle', [
            'row' => $row,
        ]);
        echo $this->view('includes/footer');
    }
}
