<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{$site_url}"><img src="{$wp_path}/img/logo.png"></a>
        </div>
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
