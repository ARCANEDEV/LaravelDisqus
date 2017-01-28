<script>
    var disqus_config = function () {
@if ($pageUrl)
        this.page.url = '{{ $pageUrl }}';
@endif
@if ($pageId)
        this.page.identifier = '{{ $pageId }}';
@endif
@if ($language)
        this.language = '{{ $language }}';
@endif
    };
    (function() {
        // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');

        s.src = '//{{ $username }}.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\" rel=\"nofollow\">comments powered by Disqus.</a></noscript>
