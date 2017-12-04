<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{$site_url}">{$page['site_name']}</a>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                {foreach from=$menu key=k item=v}
                    <li>
                        {if empty($v->subpages)}
                            <a href="{$v->url}" class="{$v->active}">{$v->title}</a>
                        {else}
                            <a data-toggle="dropdown" class="dropdown-toggle" href="">{$v->title} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                {foreach from=$v->subpages key=k2 item=v2}
                                    <li><a href="{$v2->url}" class="{$v->active}">{$v2->title}</a></li>
                                {/foreach}
                            </ul>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
