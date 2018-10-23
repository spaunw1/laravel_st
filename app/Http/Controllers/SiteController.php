<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $p_rep; //portfolio repository
    protected $s_rep; //sliders repository
    protected $a_rep; //articles repository
    protected $m_rep; //menus repository
    protected $template;
    protected $vars = array();

    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    protected $bar = false;

    public function __construct() {
      
    }

    protected function renderOutput() {


      return view($this->template)->with($this->vars);
    }
}
