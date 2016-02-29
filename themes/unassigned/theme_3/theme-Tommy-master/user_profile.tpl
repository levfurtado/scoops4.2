{{ config_load file="{{ $gimme->language->english_name }}.conf" }}
{{ include file="_tpl/_html-head.tpl" }}

<body id="body">
<!--[if lt IE 7]>
    <p class="chromeframe">{{ #outdatedBrowser# }}</p>
<![endif]-->
          
{{ include file="_tpl/header.tpl" }}

<main role="main" class="main site-archive">
    <section class="main-alpha">
        {{ include file="_tpl/user_profile-cont.tpl" }}
    </section>
    <aside class="main-beta clearfix" role="complementary">
        {{ if $user->isAuthor() }}
        {{ include file="_tpl/user-articles.tpl" }}          
        {{ else }}
        {{ include file="_tpl/user-comments.tpl" }}          
        {{ /if }}
        {{ include file="_tpl/user-sidebar.tpl" }}
    </aside>
</main> <!-- end main role main -->

{{ include file="_tpl/footer.tpl" }}

{{ include file="_tpl/_html-foot.tpl" }}