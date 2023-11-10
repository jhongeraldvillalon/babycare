<?php

class Switch_hospital extends Controller
{
    public function index($id = '')
    {
        Auth::switch_hospital($id);
        $this->redirect("hospitals");
    }
}
