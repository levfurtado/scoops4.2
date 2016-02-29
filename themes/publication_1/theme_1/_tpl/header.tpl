<!-- <ul class="skiplinks">
  <li class="acc"><a href="#main">Skip to content</a></li>
  {{ local }}
  {{ set_current_issue }}
  {{ list_sections }}
    <li{{ if ($gimme->section->number == $gimme->default_section->number) && ($gimme->template->name == "section.tpl" || $gimme->template->name == "article.tpl") }} class="acc nav-current"{{ else }} class="acc"{{ /if }}><a href="{{ uri options="section" }}">Skip to {{ $gimme->section->name }}</a></li>
  {{ /list_sections }}
  {{ /local }}
</ul> -->
<link href='https://fonts.googleapis.com/css?family=UnifrakturCook:700' rel='stylesheet' type='text/css'>
<div class="header-image">
  <div class="header-title">
    <h1 class="header-text">
      <span>The Cape Cod</span>
      <span> Chronicle</span>
     </h1>
  </div>
  <img src="../../../images/bridge250px.jpg" alt="">
</div>
<header class="header-main clearfix" role="banner">
  <div class="container-wrap">
    <div class="container">
      <div class="row twelve">
        <div class="row-item one">
          <h1 class="logo-header"><a class="logo-alpha" href="#">CCC</a></h1>
        </div>
        <div class="row-item six">
          <nav id="nav-top" class="nav-alpha nav" role="navigation">
            <ul class="menu-nav">
              <li{{ if $gimme->template->name == "front.tpl" }} class="nav-current"{{ /if }}><a class="ease" href="/">{{ #home# }}</a></li>
              {{ set_current_issue }}
              <li>
                <a href="">Sections</a>
                <ul class="submenu">
                  <li><a href="#">Chatham News</a></li>
                  <li><a href="#">Harwich News</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Opinion</a></li>
                  <li><a href="#">Obituaries</a></li>
                </ul>
              </li>
              <li><a href="">Advertising</a></li>
              <li><a href="">Archives</a></li>
              <li><a href="">Contact</a></li>
              <li><a href="">Subscribe</a></li>
              </ul>
          </nav>
        </div>
        <div class="row-item five">
          <a href="#body" class="nav-link nav-link-open icon-list"> {{ #sections# }}</a>
          <a href="#" class="nav-link nav-link-close icon-list"> {{ #sections# }}</a>
          {{ search_form template="search.tpl" submit_button="Search" html_code="role=\"search\" class=\"search-field-alpha\""}}
            <label class="acc" for="f_search_keywords">{{ #search# }}</label>
            <input classs="inp-f" id="f_search_keywords" type="search" required aria-required="true" placeholder="{{ #keywords# }}" name="f_search_keywords">
          {{ /search_form }}



          <ul class="nav-top">
          <!--  <li><span>{{#language#}}: <a href="#">En</a> | <a href="#">De</a></span></li>-->
            <li><a href="{{ $view->url(['controller' => 'user', 'action' => 'index'], 'default') }}" title="Community index">{{ #community# }}</a></li>
            {{ if !$gimme->user->logged_in}}
            <li><a href="{{ $view->url(['controller' => 'auth', 'action' =>'index'], 'default') }}"> {{ #login# }} </a></li>
            {{ else }}
            <li><a href='{{ $view->url(['username' => $gimme->user->uname], 'user') }}'>{{ #profile# }}</a></li>
            <li><a href="{{ $view->url(['controller' => 'auth', 'action' =>'logout'], 'default') }}">{{ #logout# }}</a></li>
            {{ /if }}
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
