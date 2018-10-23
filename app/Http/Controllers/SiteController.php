<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\MenusRepository;

use Menu;

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

    $navigation = view(env('THEME') . '.navigation')->with('menu', $menu)->render();
    $this->vars = array_add($this->vars, 'navigation', $navigation);

    return view($this->template)->with($this->vars);
  }

  protected function getMenu() {

    $menu = $this->m_rep->get();

    $mBuilder = Menu::make('MyNav', function ($m) use ($menu) {
      foreach($menu as $item) {
        if ($item->parent == 0) {
          $m->add($item->title, $item->path)->id($item->id);
        } else {
          if($m->find($item->parent)) {
            $m->find($item->parent)->add($item->title,['url' => $item->path, 'parent' => $item->parent])->id($item->id);
          }
        }
      }
    });

//    dd($mBuilder);

    return $mBuilder;
  }
}
