<?php
/**
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<div id="dokuwiki__header"><div class="pad group">
  
    <?php tpl_includeFile('header.html') ?>

	<div class="relHeaderSpacer">
        </div>

    <div class="tools">
        <!-- USER TOOLS -->
        <?php if ($conf['useacl']): ?>
            <div id="dokuwiki__usertools">
                <h3 class="a11y"><?php echo $lang['user_tools']; ?></h3>
                <?php
                    if (!empty($_SERVER['REMOTE_USER'])) {
                        echo '<span class="user">';
                        tpl_userinfo();
                        echo '</span>';
                    }
				?>
                <ul>
                    <?php
                        tpl_action('recent', 1, 'li class="recent"');
                        tpl_action('media', 1, 'li class="media"');
                        tpl_action('admin', 1, 'li class="admin"');
                        tpl_action('profile', 1, 'li class="profile"');
                        tpl_action('register', 1, 'li class="register"');
                        tpl_action('login', 1, 'li class="login"');
//                      tpl_action('index', 1, 'li');
                    ?>
                </ul>
                <div class="mobileTools">
                    <?php tpl_actiondropdown($lang['tools']); ?>
                </div>
            </div>
        <?php endif ?>
    </div>

    <div class="headings group">
        <ul class="a11y skip">
            <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content']; ?></a></li>
        </ul>

        <?php

            // display logo and wiki title in a link to the home page
            tpl_link(
                wl(),
                '<span class="wikiTitle">'.$conf['title'].'</span>',
                'accesskey="h" title="[H]"'
            );
        ?>
        <?php if ($conf['tagline']): ?>
            <p class="claim"><?php echo $conf['tagline']; ?></p>
        <?php endif ?>
    </div>

   <div class="relMenu">
      <div class="relMenuItem relMenuItemSelected" ><a href="/">Wiki</a></div>
      <div class="relMenuItem" ><a href="http://rel-tfg.neyrick.fr" >Planning des parties</a></div>
      <div class="relMenuItem" ><a href="http://reves-et-legendes.forum2jeux.com">Forum</a></div>
      <div class="relMenuItem rightMenu" ><?php tpl_searchform(); ?></div>      
    </div>


	<?php
            // get logo either out of the template images folder or data/media folder
            $nsbreak = explode(":", $INFO['namespace']);
            if (count($nsbreak) > 0) $firstns = ":" . $nsbreak[0] . ":banner.png";
            else $firstns = ":banner.png";
            $logoSize = array();
            $logo = tpl_getMediaFile(array($firstns,':banner.png'), false, $logoSize);
		
	?>
    <div class="relHeaderPic">
      <img src="<?php echo $logo ?>" <?php echo $logoSize[3] ?> alt="" />
    </div>

    <!-- BREADCRUMBS -->
    <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
        <div class="breadcrumbs">
            <?php if($conf['youarehere']): ?>
                <div class="youarehere"><?php tpl_youarehere() ?></div>
            <?php endif ?>
            <?php if($conf['breadcrumbs']): ?>
                <div class="trace"><?php tpl_breadcrumbs() ?></div>
            <?php endif ?>
        </div>
    <?php endif ?>

    <?php html_msgarea() ?>

    <hr class="a11y" />
</div></div><!-- /header -->
