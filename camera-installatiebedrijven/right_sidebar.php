<html>
  <body>
    <div class="col-sm-2 sidenav">

      <!--Om een ander acount in de api van twitter te laden verander de href en de test: Tweets by @....--> 
      <a class="twitter-timeline" href="https://twitter.com/negrosuketa" data-widget-id="697792877175382016">Tweets by @negrosuketa</a>
      <br>
      <br>
      <div class="well">
        <a href="nieuws"><p class="nieuws">Nieuws</p></a>
        <hr style="border-top: 1px solid #B5A7C6;">
          <?php
            sidenieuws();
          ?>
      </div>
    </div>
  </body>
</html>