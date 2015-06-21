<section class="intro-content">
    <div class="row">
        <div class="col-12">
            <h1 class="title">$Title</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            $Content
        </div>
    </div>
</section>

<section class="filter-control">
    <div class="row">
        <div class="col-12">
            <ul>
                <li>
                    <div class="filter" data-filter="all">Show All</div>
                </li>
                <% loop ImageTag %>
                    <li>
                        <div class="filter" data-filter=".category-$Title">$Label</div>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </div>
</section>

<section class="gallery-images">
    <div class="row container" id="container">
        <% loop getThumbnailImage %>

        <div class="col-2 mix <% loop $getTag %>category-$Title <% end_loop %>">
            <a href="$RemoteLink" class="light-box"
               title="<% if $Title %><h1>$Title</h1><% end_if %> <% if $Description %><p>$Description</p><% end_if %>">$ThumbnailImage</a>
        </div>

        <% end_loop %>
    </div>
</section>
