<?php

  /*
    Q2A Bootstrap by Harsh Vakharia

    http://github.com/harshjv
    http://twitter.com/harshjv

    GPLv2
    */

class qa_html_theme extends qa_html_theme_base {

  function nav($navtype, $level=null) {
    $navigation=@$this->content['navigation'][$navtype];

    if (($navtype=='user') || isset($navigation)) {
      $this->output('<div class="qa-nav-'.$navtype.'">');

      if ($navtype=='user')
        $this->logged_in();
      $rev_navigation = array_reverse($navigation, true);
      foreach ($rev_navigation as $key => $navlink)
        if (@$navlink['opposite']) {
          unset($navigation[$key]);
          $navigation[$key]=$navlink;
        }

      $this->set_context('nav_type', $navtype);
      $this->nav_list($navigation, 'nav-'.$navtype, $level);
      $this->nav_clear($navtype);
      $this->clear_context('nav_type');
  
      $this->output('</div>');
    }
  }

  function head_css() {
    qa_html_theme_base::head_css();
    $this->output('<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"/>');
  }

  function head_script() {
    qa_html_theme_base::head_script();
    $this->output('<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>');
  }

  function body_content() {
    $this->body_prefix();
    $this->notices();
    $this->widgets('full', 'top');
    $this->header();
    $this->widgets('full', 'high');
    $this->sidepanel();
    $this->main();
    $this->widgets('full', 'low');
    $this->footer();
    $this->widgets('full', 'bottom');
    $this->body_suffix();
  }

  function header() {
    $this->bs_navbar();
  }

  function bs_navbar() {
    $nav_html = '<nav class="navbar navbar-default" role="navigation">'
                  .'<div class="container">'
                    .'<div class="navbar-header">'
                      .'<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#q2a-bs-collapse">'
                        .'<span class="sr-only">Toggle</span>'
                        .'<span class="icon-bar"></span>'
                        .'<span class="icon-bar"></span>'
                        .'<span class="icon-bar"></span>'
                      .'</button>'
                      .'<a class="navbar-brand" href="'.qa_path_html().'">'.qa_opt('site_title').'</a>'
                    .'</div>'
                    .'<div class="collapse navbar-collapse" id="q2a-bs-collapse">'
                      .'<ul class="nav navbar-nav navbar-right">';
    foreach ($this->content['navigation']['user'] as $unav) {
      $nav_html.='<li><a href="'.$unav['url'].'">'.$unav['label'].'</a></li>';
    }
    $nav_html.='</ul>'
              .'</div>'
            .'</div>'
          .'</nav>';
    $this->output($nav_html);
  }

}