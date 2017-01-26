<script>
    var disqus_config = function () {
        this.page.url = '{{ $pageUrl }}';
        this.page.identifier = '{{ $pageId }}';
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
