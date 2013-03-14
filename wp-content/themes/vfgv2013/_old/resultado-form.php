<div id="content" class="SingleDesafio">
  <div id="inner-content" class="wrap clearfix">
    <div id="main" class="eightcol clearfix" role="main">
      <h1>Desafio -
        <?php the_title(); ?>
      </h1>
      <p><?php echo $_GET['actions']; ?></p>
      <style>body {overflow: visible !important;}.inputs {float:right;}label[for='win_no']{float:right;} .inputs label {float:left;clear: left;padding: 3px;}label input {display:inline-block; margin: 0 3px; vertical-align:middle;}.fb_comment { border-bottom:solid 1px #666; padding:20px;}.remove {color: #c00;}.commentBody  {width:525px;margin-left:70px;}.fb_comment img {margin-bottom:-60px}</style>
      <form id='commentAdmin' action="<?php bloginfo('template_url') ?>/fb_comments.php" method="post">
        <div class="fb_comment">
          <input type="hidden" name="commentAdminPostID" value="<?php echo $activePost ?>"/>
          <input type="hidden" name="redirect" value="<?php the_permalink($activePost); ?>"/>
          <label for="submit" class="defaults">
            <input type="submit" name="submit" id="submit" value="Atualizar">
          </label>
          <label class="win" for="win_no">
            <input type="checkbox" name="no_winner" id='win_no' value="none"/>
            Não Vencedor</label>
          <div class="clearfix"></div>
        </div>
        <?php printComments($allComments, 'winners'); ?>
        <div class="fb_comment">
          <label for="submit" class="defaults">
            <input type="submit" name="submit" id="submit"  value="Atualizar">
          </label>
          <input type="hidden" name="redirect" value="<?php the_permalink($activePost); ?>"/>
          <label class="win" for="win_no">
            <input type="checkbox" name="no_winner" id='win_no' value="none"/>
            Não Vencedor</label>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
    <!-- end #main --> 
  </div>
  <!-- end #inner-content --> 
</div>
<!-- end #content --> 