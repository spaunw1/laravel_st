<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\MenusRepository;

class SiteController extends Controller {
  protected $p_rep; //portfolio repository
  protected $s_rep; //sliders repository
  protected $a_rep; //articles repository
  protected $m_rep; //menus repository
  protected $template;
  protected $vars = array();

  protected $contentRightBar = FALSE;
  protected $contentLeftBar = FALSE;

  protected $bar = FALSE;

  public function __construct(MenusRepository $m_rep) {
    $this->m_rep = $m_rep;
  }

  protected function renderOutput() {

    $menu = $this->getMenu();

    $navigation = view(env('THEME') . '.navigation')->render();
    $this->vars = array_add($this->vars, 'navigation', $navigation);

    return view($this->template)->with($this->vars);
  }

  protected function getMenu() {

    $menu = $this->m_rep->get();

  }
}
