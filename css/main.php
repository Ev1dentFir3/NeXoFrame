<?php
  header("Content-type: text/css; charset: UTF-8");
  include_once '../includes/userdata/config.php';
  if (file_exists('../includes/themes/'.$theme.'/theme.php')) {
    include_once '../includes/themes/'.$theme.'/theme.php';
  } else {
    $theme="default";
    include_once '../includes/themes/'.$theme.'/theme.php';
  }
?>

@import url('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=cyrillic');
* {
  font-family: 'Open Sans Condensed', sans-serif;
  margin: 0;
  padding: 0;
  text-transform: uppercase;
}

::-webkit-scrollbar {
  height: 3px;
  width: 3px;
}

::-webkit-scrollbar-track {
  background: <?=$color_background4?>;
}

::-webkit-scrollbar-thumb {
  background: <?=$color_primary?>;
}

body {
  background-color: <?=$color_background3?>;
  color: <?=$color_primary?>;
  margin: 50px 0 0 0;
  padding: 0;
}

nav {
  margin-top: -50px;
  position: fixed;
  width: 100%;
  z-index: 999;
}

nav ul {
  background-color: <?=$color_background2?>;
  box-shadow: 0 2px 3px 0 <?=$color_background7?>;
  cursor: default;
  list-style: none;
  text-align: left;
  -moz-box-shadow: 0 2px 3px 0 <?=$color_background7?>;
  -webkit-box-shadow: 0 2px 3px 0 <?=$color_background7?>;
}

nav li,nav a,#settings {
  transition: .3s;
}

nav li {
  cursor: pointer;
  display: inline-block;
  font-family: 'Oswald', sans-serif;
  font-size: 12pt;
  height: 50px;
  line-height: 50px;
  margin: auto 0;
  text-align: center;
  transform: skew(-8deg);
}

nav a {
  color: <?=$color_primary?>;
  display: block;
  margin: auto 10px;
  text-decoration: none;
}

nav a:hover {
  color: <?=$color_secondary?>;
}

nav a i {
  margin-right: 5px;
}

nav li:hover {
  background-color: <?=$color_background1?>;
}

nav li.active {
  background-color: <?=$color_background1?>;
  border-bottom: 2px solid <?=$color_secondary?>;
  color: #444;
  cursor: default;
  height: 48px;
}

nav li.active a {
  color: <?=$color_primary?>;
  cursor: default;
}

.navHome {
  display: inline-block;
  transform: skew(0deg);
}

.navHome svg {
  height: 46px;
  margin-top: -4px;
  vertical-align: middle;
  width: 46px;
}

svg path, .navHome path {
  fill: <?=$color_primary?>;
}

.navHome:hover {
  background-color: transparent;
  fill: <?=$color_secondary?>;
}

.navSettings {
  float: right;
  margin-right: -4px;
}

.navSettings a {
  margin-right: 14px;
}

.worldstate {
  background: <?=$color_background4?> url(../includes/themes/<?=$theme?>/background.png) center top no-repeat;
  background-position: right top, left top, center top;
  background-repeat: no-repeat, no-repeat, repeat-x;
  background-size: cover;
  box-shadow: inset 0 -3px 2px -2px <?=$color_background7?>;
  height: 420px;
  overflow: auto;
  -moz-box-shadow: inset 0 -3px 2px -2px <?=$color_background7?>;
  -webkit-box-shadow: inset 0 -3px 2px -2px <?=$color_background7?>;
}

.worldstate h2 {
  color: <?=$color_active?>;
  float: left;
  font-weight: normal;
  margin: 10px;
  transform: skew(-8deg);
}

#worldstateTabs {
  cursor: pointer;
  float: left;
  list-style: none;
  padding: 0;
}

#worldstateTabs li {
  background: <?=$color_background7?>;
  background: linear-gradient(to right, <?=$color_select?> 50%, <?=$color_background7?> 50%);
  background-position: right bottom;
  background-size: 200% 100%;
  border-right: 2px solid <?=$color_border?>;
  font-size: 15px;
  height: 42px;
  line-height: 42px;
  overflow: hidden;
  transition: all .2s ease;
  vertical-align: middle;
  width: 42px;
}

#worldstateTabs li:hover {
  background-position: left bottom;
  border-right: 2px solid <?=$color_primary?>;
}

#worldstateTabs svg path {
  fill: <?=$color_active?>;
}

.active {
  background: <?=$color_select?> !important;
  border-right: 2px solid <?=$color_primary?> !important;
}

.active svg path, svg.archwing path {
  fill: <?=$color_primary?> !important;
}

#worldstateTabs svg {
  display: inline-block;
  float: left;
  height: 26px;
  margin: 7px;
  width: 26px;
}

#alertsIcon svg {
  margin: 7px 9px 9px 7px;
}

#invasionsIcon svg {
  margin: 8px;
}

#syndicatesIcon svg {
  margin: 8px;
}

#sortiesIcon svg {
  margin: 7px 8px 9px 8px;
}

#conclaveIcon svg {
  margin: 8px;
}

#conclaveMissionsIcon svg {
  margin: 8px;
}

#bountyIcon svg {
  margin: 8px;
}

#voidTraderIcon svg {
  margin: 8px 7px 8px 9px;
  width: 24px;
}

svg.archwing, svg.nightmare {
  height: 18px;
  width: 18px;
  margin-bottom: -3px;
}

#alertIcon:hover svg path,
#invasionIcon:hover svg path,
#syndicateIcon:hover svg path,
#fissureIcon:hover svg path,
#sortieIcon:hover svg path,
#conclaveIcon:hover svg path,
#conclaveMissionIcon:hover svg path,
#bountyIcon:hover svg path,
#voidTraderIcon:hover svg path,
#acolyteIcon:hover svg path,
#eventIcon:hover svg path {
  fill: <?=$color_primary?>;
}

#conclaveMissionsIcon {
  margin-right: 0;
}

.activeCount {
  background-color: <?=$color_background7?>;
  color: <?=$color_primary?>;
  display: block;
  font-size: 13px;
  font-weight: bold;
  line-height: 12px;
  margin: -40px auto auto 23px;
  min-width: 14px;
  position: absolute;
  text-align: center;
  text-shadow: 1px 0 1px <?=$color_background7?>;
  transform: skew(-8deg);
}

#settings {
  color: <?=$color_active?>;
  float: right;
  font-size: 22px;
}

#settings:hover {
  color: <?=$color_primary?>;
}

li#settings {
  margin-left: 28px !important;
  width: 22px;
}

header h2,aside {
  margin: 15px;
}

header h2 {
  color: <?=$color_primary?>;
}

.worldstatePanel {
  display: block;
  height: 420px;
  text-align: center;
}

.worldstatePanel table {
  background-color: <?=$color_background7?>;
  border-collapse: collapse;
  text-shadow: 2px 1px 2px <?=$color_background7?>;
  width: 400px;
  height: 100%;
}

.worldstatePanel table td {
  margin: 21px 10px;
}

.worldstatePanel table tr {
  border-bottom: 1px solid <?=$color_border?>;
  border-left: 1px solid <?=$color_border?>;
}

.worldstateCenter, .worldstateRight {
  height: 100%;
  overflow: hidden;
  float: right;
}

.worldstateLeft {
  display: block;
  width: auto;
}

.worldstateRight {
  margin-left: 3px;
}

.tableLeft {
  float: left;
  font-weight: bold;
}

.tableRight {
  float: right;
}

#cetusHeaderIcon path,
#ostronsHeaderIcon path,
#earthHeaderIcon,#baroHeaderIcon path {
  fill: <?=$color_primary?>;
}

#cetusHeaderIcon {
  height: 20px;
  margin-bottom: -4px;
  margin-left: 1px;
  margin-right: 3px;
  width: 20px;
}

#ostronsHeaderIcon {
  height: 26px;
  margin-bottom: -5px;
  margin-left: -4px;
  width: 26px;
}

#earthHeaderIcon {
  height: 18px;
  margin-bottom: -3px;
  margin-left: 2px;
  margin-right: 5px;
  width: 18px;
}

#baroHeaderIcon {
  height: 22px;
  margin-bottom: -5px;
  margin-left: 2px;
  margin-right: 4px;
  width: 22px;
}

.worldstatePanelRight {
  height: 420px;
}

.worldstatePanelRight td {
  display: block;
  margin: 20px !important;
}

#newsList {
  font-size: 16px;
  list-style-type: none;
  margin-top: 6px;
}
#newsList li {
  display: table;
  margin: 0px auto;
}
#newsList li span {
  margin: 6px;
}

#newsList a {
  color: <?=$color_primary?>;
  text-decoration: none;
}

#newsList a:hover {
  color: <?=$color_secondary?>;
}

.dailyDealsInventory {
  width: 100%;
}

.dailyDealsInventory thead th {
  height: 40px;
}

.dailyDealsInventory img {
  height: 16px;
  width: 16px;
  margin-bottom: -2px;
}

.dailyDealsInventory thead th svg {
  height: 18px;
  width: 18px;
}

.dailyDealsInventory svg path {
  fill: <?=$color_primary?>;
}

.dailyDealsInventory tr {
  border: 0 !important;
}

#invasionsList svg {
  height: 22px;
  width: 22px;
}

.constructTitle {
  border-bottom: 0 !important;
}

.constructTitle > * {
  height: 45px;
  vertical-align: bottom !important;
}

.constructPanel {
  border-bottom: 0 !important;
  border-top: 0 !important;
}

tr.constructPanel, tr.darvoDeals {
  height: 156px;
}

.constructPanel td > * {
  vertical-align: middle;
}

.constructPanel td span {
  margin: auto 5px;
}

.darvoDeals {
  border-bottom: 0 !important;
}

.dailyDealsTable table {
  background: transparent !important;
}

.constructionBar {
  border-radius: 100%;
  display: inline-block;
  height: 60px;
  margin: 10px;
  position: relative;
  text-indent: -9999px;
  width: 60px;
}

.constructionBar:after {
  background: <?=$color_background3?>;
  background-size: cover;
  border-radius: 100%;
  content: attr(data-percentage) '%';
  font-size: 0;
  height: 56px;
  left: 50%;
  line-height: 65px;
  position: absolute;
  text-align: center;
  text-indent: 0;
  top: 50%;
  transform: translate(-50%, -50%);
  vertical-align: middle;
  width: 56px;
}

#grineerConstructEmblem,
#corpusConstructEmblem {
  height: 22px;
  margin-bottom: -5px;
  width: 22px;
}

#grineerConstructEmblem path,
#corpusConstructEmblem path {
  fill: <?=$color_primary?>;
}

#grineerConstruct:after {
  background: <?=$color_background3?> url(../img/fomorian.png) center no-repeat;
  background-size: contain;
}

#corpusConstruct:after {
  background: <?=$color_background3?> url(../img/razorback.png) center no-repeat;
  background-size: contain;
}

#constructState1 {
  margin-bottom: 17px;
}

#constructState2, .eventTimer {
  text-align: center;
}

.activeEvent {
  color: <?=$color_background7?>;
}

.eventAtk {
  height: 80px;
  width: auto;
}

.worldstateFrame {
  height: 378px;
  overflow-y: scroll;
  overflow-x: hidden;
}

.worldstateContainer {
  background-color: <?=$color_background7?>;
  border: 1px solid <?=$color_border?>;
  display: block;
  margin: 3px;
}

.containerTitle {
  overflow-y: hidden;
}

.containerTitle span {
  font-size: 20px;
  padding: 5px 10px;
  background-color: <?=$color_background7?>;
  border: 1px solid <?=$color_border?>;
  display: block;
  text-align: center;
  margin: 3px 0 0 3px;
}

.alertTable, .invasionTable {
  display: flex;
  justify-content: space-between;
}

.alertTable {
  margin: 14px 4px 14px 0;
}

.invasionTable {
  margin: 14px;
}

#sortieList,
.sortieBoss li {
  list-style: none;
}

.sortieBoss span {
  line-height: 43px;
  font-size: 20px;
  font-weight: bold;
}

.sortieBoss li {
  margin: 15px 14px;
}

svg.sortieFaction {
  margin: auto 6px -8px auto;
  height: 32px;
  width: 32px;
}

#sortieList ul {
  margin: 40px 14px;
}

#bountyTab tbody {
  display: block;
}

#bountyTab tbody tr {
  width: 100%;
}

.bountyRewardPool {
  border-left: 1px solid <?=$color_border?>;
  width: 180px !important;
}

.bountyRewardPool li {
  text-align: center !important;
}

#alertType {
  text-transform: uppercase;
}

.alertReward {
  object-fit: contain;
  float: left;
  height: 60px;
  width: 96px;
  margin: 3px;
}

.fissureTier {
  float: left;
  height: 65px;
  width: 65px;
  margin: 0 14px;
}

svg.fissureTier path {
  fill: <?=$color_primary?>;
}

#alertItems {
  height: 16px;
  margin: -2px 2px;
}

.alertFaction {
  float: right;
  height: 58px;
  margin: auto 10px;
  opacity: .2;
  width: 58px;
}

svg.svg.alertFaction path {
  fill: <?=$color_active?>;
}

.alertFactionA, .alertFactionD {
  height: 20px;
  width: 20px;
}

.alertFactionA {
  margin: 0 4px -4px 0;
}

.alertFactionD {
  margin: 0 0 -4px 4px;
}

.alertTimer, .fissureTimer {
  border-top: 1px solid <?=$color_border?>;
  display: block;
  text-align: center;
  font-size: 14px;
  padding: 3px;
}

#alertbody, #invasionbody, #fissurebody, #bountybody, #bountiesList td ul, #darvobody {
  list-style-type: none;
}

.standing {
  height: 20px;
  width: 20px;
}

.worldstateContainer ul,
#worldstateType ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.worldstateContainer ul {
  width: 100%;
}

.worldstateContainer ul li {
  text-align: left;
  white-space: nowrap;
}

.progress, .Corpus, .Grineer, .Infested {
  opacity: .9;
}

.progress, .progress span {
  height: 5px;
}

.progress span {
  display: block;
  overflow: hidden;
}

.corpus-color {
  background-color: <?=$color_corpus?>;
}

.grineer-color {
  background-color: <?=$color_grineer?>;
}

.infested-color {
  background-color: <?=$color_infested?>;
}

#invasionTitle {
  text-align: center;
  margin-bottom: 11px;
}

#invasionSideA,#invasionSideD {
  margin-bottom: 6px;
  width: 50%;
}

#invasionRewardA,#invasionRewardD {
  font-size: 11pt;
  margin-top: 6px;
}

#invasionSideA,#invasionRewardA {
  float: left;
  text-align: left;
}

#invasionSideD,#invasionRewardD {
  float: right;
  text-align: right;
}

article header {
  background: <?=$color_background4?>;
  box-shadow: inset 0 -3px 4px -2px <?=$color_background7?>;
  height: 45px;
  -moz-box-shadow: inset 0 -3px 4px -2px <?=$color_background7?>;
  -webkit-box-shadow: inset 0 -3px 4px -2px <?=$color_background7?>;
}

article header h3 {
  margin: 0;
  padding: 10px 15px;
}

#currentPlatform {
  float: right;
  height: 22px;
  opacity: .5;
  width: 22px;
}

#currentPlatform path {
  fill: <?=$color_primary?>;
}
