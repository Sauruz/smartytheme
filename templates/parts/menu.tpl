<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{$site_url}">{$page['site_name']}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    {foreach from=$menu key=k item=v}
                        {if empty($v->subpages)}
                            <li class="nav-item {$v->active}">
                                <a class="nav-link" href="{$v->url}">{$v->title}</a>
                            </li>
                        {else}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{$v->url}" id="dropdown{$k}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$v->title}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown{$k}">
                                    {foreach from=$v->subpages key=k2 item=v2}
                                        <a class="dropdown-item {$v->active}" href="{$v2->url}">{$v2->title}</a>
                                    {/foreach}
                                </div>
                            </li>
                        {/if}
                    {/foreach}
                </ul>
            </div>
        </div>
    </nav>
</header>