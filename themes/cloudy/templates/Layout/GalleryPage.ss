<div class="page-header">
    <h1>$Title.RAW</h1>
</div>

<div class="row-fluid">
    <div class="span3">
        <% include Sidebar %>
    </div>
    <div class="span9 typography">
        <div class="span9">
            <ul class="thumbnails">
                <% loop GalleryImages %>
                <li class="span2">
                    <a class="thumbnail fancybox-thumb" href="$Image.setWidth(400).URL" title="$Title"
                       rel="fancybox-thumb">
                        <img src="$Image.URL"/>
                    </a>
                </li>
                <% end_loop %>
            </ul>
            <script type="text/javascript">
                $(document).ready(function () {
                    $(".fancybox-thumb").fancybox({
                        openEffect:"none",
                        closeEffect:"none"
                    });
                });

            </script>

            <div class="clearfix">
                $Content
            </div>
        </div>

    </div>

</div>

</div>