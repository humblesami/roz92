<style type="text/css">
 
#share-buttons img {
width: 35px;
padding: 5px;
border: 0;
box-shadow: 0;
display: inline;
border-radius: 5px !important;
    box-sizing: border-box
}
 
</style>
<?php

$share_url = (isset($share_url)) ? $share_url : '#';
?>
<!-- I got these buttons from simplesharebuttons.com -->
<div id="share-buttons" >
    
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
    </a>

   <!-- Twitter -->
    <a href="https://twitter.com/share?url=<?php echo $share_url;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
    </a>

  <!-- LinkedIn -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $share_url;?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
    </a>

  <!-- Email -->
    <a href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo $share_url;?>">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
    </a>
 

    

    

    

    
    <!-- Print -->
    <a href="javascript:;" onclick="window.print()">
        <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
    </a>
    
 
    

    

     

    
  

</div>

 <!-- adds code -->
          <?php echo $this->render('add_detail') ?>
          <!-- adds code -->

<div id="disqus_thread"></div>
<script>
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://roznama-92-news.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            


<script id="dsq-count-scr" src="//roznama-92-news.disqus.com/count.js" async></script>

