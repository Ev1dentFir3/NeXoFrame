<?php
include_once "includes/userdata/config.php";
include_once 'includes/languages/'.$lang.'.php';
if (file_exists('includes/themes/'.$theme.'/theme.php')) {
  include_once 'includes/themes/'.$theme.'/theme.php';
} else {
  $theme="default";
  include_once 'includes/themes/'.$theme.'/theme.php';
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <title><?=$title?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta content="<?=$desc?>" name="description">
    <meta content="<?=$keywords?>" name="keywords">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="css/main.php" rel="stylesheet" type="text/css">
    <link href="css/jquery.scrollbar.php" rel="stylesheet" type="text/css">
    <link href="css/simple-line-icons.css" rel="stylesheet">
  </head>
  <body>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.min.js"></script>
    <script src="js/jquery.scrollbar.js"></script>
    <header>
      <nav>
        <ul>
          <li class="navHome"><a href="#"><img class="svg" src="img/logo.svg"></a></li>
          <li><a href="#"><i class="icon-bubbles icons"></i><?=$lang_nav_forum?></a></li>
          <li><a href="#"><i class="icon-map icons"></i><?=$lang_nav_dojo?></a></li>
          <li><a href="#"><i class="icon-notebook icons"></i><?=$lang_nav_rules?></a></li>
          <li><a href="#"><i class="icon-doc icons"></i><?=$lang_nav_about?></a></li>
          <li><a href="#"><i class="icon-link icons"></i><?=$lang_nav_links?></a></li>
          <li><a href="<?=$chatlink?>"><i class="icon-microphone icons"></i><?=$lang_nav_voice_chat?></a></li>
          <li class="navSettings"><a href="#"><i class="icon-settings icons"></i><?=$lang_nav_settings?></a></li>
        </ul>
      </nav>
      <div class="worldstate">
        <ul id="worldstateTabs">
          <li id="alertIcon" class="active"><img class="svg" src="img/navigation/alerts.svg"></li>
          <li id="invasionIcon"><img class="svg" src="img/navigation/invasions.svg"></li>
          <li id="fissureIcon"><img class="svg" src="img/navigation/fissures.svg"></li>
          <li id="sortieIcon"><img class="svg" src="img/navigation/sorties.svg"></li>
          <li id="conclaveIcon"><img class="svg" src="img/syndicates/conclave.svg"></li>
          <li id="conclaveMissionIcon"><img class="svg" src="img/navigation/conclave_missions.svg"></li>
          <li id="bountyIcon"><img class="svg" src="img/syndicates/ostrons.svg"></li>
          <li id="voidTraderIcon"><img class="svg" src="img/baro.svg"></li>
          <li id="acolyteIcon"><img class="svg" src="img/navigation/acolytes.svg"></li>
          <li id="eventIcon"><img class="svg" src="img/navigation/quests.svg"></li>
        </ul>
        <div class="worldstateCenter">
          <div class="worldstatePanel">
            <table>
              <tr>
                <td colspan="1">
                  <h3><?=$lang_nav_news?></h3>
                  <ul id="newsList">
                    <li id="newstop"></li>
                    <li id="newsbody"><span id="newstitle"></span></li>
                  </ul>
                </td>
              </tr>
              <tr class="darvoDeals">
                <td class="dailyDealsTable tableLeft" colspan="2">
                  <li id="darvobody"> <span id="darvotitle"><?=$lang_info_updating?></span> </li>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="worldstateRight">
          <div class="worldstatePanel">
            <table>
              <tr>
                <td class="tableLeft">
                  <span><img id="cetusHeaderIcon" class="svg" src="img/relay.svg"><?=$lang_header_cetus?></span>
                </td>
                <td class="tableRight">
                  <span id="cetuscycleindicator"><?=$lang_info_updating?></span>: <span id="cetuscycletime"></span>
                </td>
              </tr>
              <tr>
                <td class="tableLeft">
                  <span><img id="ostronsHeaderIcon" class="svg" src="img/syndicates/ostrons.svg"><?=$lang_header_ostrons_bounty?></span>
                </td>
                <td class="tableRight">
                  <span id="cetusbountytitle"><?=$lang_info_updating?></span> <span id="cetusbountytime"></span>
                </td>
              </tr>
              <tr>
                <td class="tableLeft">
                  <span><img id="earthHeaderIcon" class="svg" src="img/earth.svg"><?=$lang_header_earth?></span>
                </td>
                <td class="tableRight">
                  <span id="earthcycleindicator"><?=$lang_info_updating?></span>: <span id="earthcycletime"></span>
                </td>
              </tr>
              <tr>
                <td class="tableLeft">
                  <span><img id="baroHeaderIcon" class="svg" src="img/misc/trial_nightmare.svg"><?=$lang_header_raid?></span>
                </td>
                <td class="tableRight">
                  <span id="resettimertime"></span>
                </td>
              </tr>
              <tr class="constructPanel">
                <td colspan="1">
                  <h3 id="constructState"><?=$lang_header_construction?></h3>
                  <span><img id="grineerConstructEmblem" class="svg" src="img/factions/grineer.svg"><?=$lang_faction_grineer?></span>
                  <div id="grineerConstruct" class="constructionBar"></div>
                  <div id="corpusConstruct" class="constructionBar"></div>
                  <span><?=$lang_faction_corpus?> <img id="corpusConstructEmblem" class="svg" src="img/factions/corpus.svg"></span>
                  <div class="activeEvent"></div>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="worldstateLeft">
          <div id="alertContainer">
            <div class="containerTitle">
              <span><?=$lang_header_alerts?></span>
            </div>
            <div class="alertsList worldstateFrame">
              <li id="alertbody">
                <span id="alerttitle"></span>
              </li>
            </div>
          </div>
          <div id="invasionContainer">
            <div class="containerTitle">
              <span><?=$lang_header_invasions?></span>
            </div>
            <div class="invasionList worldstateFrame">
              <li id="invasionbody">
                <span id="invasiontitle"></span>
              </li>
            </div>
          </div>
          <div id="fissureContainer">
            <div class="containerTitle">
              <span><?=$lang_header_fissures?></span>
            </div>
            <div class="fissureList worldstateFrame">
              <li id="fissurebody">
                <span id="fissuretitle"></span>
              </li>
            </div>
          </div>
          <div id="sortieContainer">
            <div class="containerTitle">
              <span><?=$lang_header_sortie?></span>
            </div>
            <div class="worldstateFrame">
              <span id="sortietitle"></span>
              <ul class="sortieBoss worldstateContainer">
                <li id="sortieBossInfo">
                  <span id="sortieFaction"></span><span id="sortieBoss"></span>
                </li>
              </ul>
              <div id="sortieList" class="worldstateContainer"></div>
            </div>
          </div>
          <div id="conclaveContainer">
            <div class="containerTitle">
              <span><?=$lang_header_conclave?></span>
            </div>
          </div>
          <div id="conclaveMissionContainer">
            <div class="containerTitle">
              <span><?=$lang_header_conclave_missions?></span>
            </div>
          </div>
          <div id="bountyContainer">
            <div class="containerTitle">
              <span><?=$lang_header_ostron_bounty?></span>
            </div>
            <div class="bountiesList worldstateFrame">
              <li id="bountybody">
                <span id="bountytitle"></span>
              </li>
            </div>
          </div>
          <div id="voidTraderContainer">
            <div class="containerTitle">
              <span><?=$lang_header_baro?></span>
            </div>
            <div id="voidTraderList">
              <li> <span id="voidtradertitle"></span>
                <span id="voidtradertime"></span>
              </li>
              <li id="voidTraderBody"></li>
            </div>
          </div>
          <div id="acolyteContainer">
            <div class="containerTitle">
              <span><?=$lang_header_acolytes?></span>
            </div>
            <div id="acolytesList">
              <li id="acolytebody">
                <span id="acolytetitle"></span>
            </div>
          </div>
        </div>
        <div id="eventContainer">
          <div class="eventTitle">
            <span><?=$lang_header_event?></span>
          </div>
        </div>
      </div>
    </header>
    <div class="pageWrapper">
      <?php include "includes/news.php";?>
    </div>

<!-- Moment CDN -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

<!-- required js for page -->
<script src="js/main.php" rel="javascript" type="text/javascript">></script>
<script src="js/svg-injector.min.js"></script>

<!-- nexoframe staff -->
<script>
function progressRender() {
  var percentageDegrees = function(p) {
    p = (p >= 100 ? 100 : p);
    var d = 3.6 * p;
    return d;
  }

  var createGradient = function (elem, d) {
    if (d <= 180) {
      d = 90 + d;
      elem.css('background', 'linear-gradient(90deg, <?=$color_background2?> 50%, transparent 50%), linear-gradient('+ d +'deg, <?=$color_primary?> 50%, <?=$color_background2?> 50%)');
    } else {
      d = d - 90;
      elem.css('background', 'linear-gradient(-90deg, <?=$color_primary?> 50%, transparent 50%), linear-gradient('+ d +'deg, <?=$color_background2?> 50%, <?=$color_primary?> 50%)');
    }
  }

  $('.constructionBar').each(function() {
    var $this = $(this);
    var percentage = $this.data('percentage');
    var degrees = percentageDegrees(percentage);
    createGradient($this, degrees);
  })
}
progressRender();

function svgInject() {
  SVGInjector(document.querySelectorAll('img'));
}
svgInject();
</script>

</body>
</html>
