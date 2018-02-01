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
/*************** SCROLLBAR BASE CSS ***************/
.scroll-wrapper {
  overflow: hidden !important;
  padding: 0 !important;
  position: relative;
}
.scroll-wrapper > .scroll-content {
  border: none !important;
  box-sizing: content-box !important;
  height: auto;
  left: 0;
  margin: 0;
  max-height: none;
  max-width: none !important;
  overflow: scroll !important;
  padding: 0;
  position: relative !important;
  top: 0;
  width: auto !important;
}
.scroll-wrapper > .scroll-content::-webkit-scrollbar {
  height: 0;
  width: 0;
}
.scroll-wrapper.scroll--rtl {
  direction: rtl;
}
.scroll-element {
  box-sizing: content-box;
  display: none;
}
.scroll-element div {
  box-sizing: content-box;
}
.scroll-element .scroll-bar,
.scroll-element .scroll-arrow {
  cursor: default;
}
.scroll-element.scroll-x.scroll-scrollx_visible, .scroll-element.scroll-y.scroll-scrolly_visible {
  display: block;
}
.scroll-textarea {
  border: 1px solid #cccccc;
  border-top-color: #999999;
}
.scroll-textarea > .scroll-content {
  overflow: hidden !important;
}
.scroll-textarea > .scroll-content > textarea {
  border: none !important;
  box-sizing: border-box;
  height: 100% !important;
  margin: 0;
  max-height: none !important;
  max-width: none !important;
  overflow: scroll !important;
  outline: none;
  padding: 2px;
  position: relative !important;
  top: 0;
  width: 100% !important;
}
.scroll-textarea > .scroll-content > textarea::-webkit-scrollbar {
  height: 0;
  width: 0;
}
/*************** SIMPLE INNER SCROLLBAR ***************/
.scrollbar-inner > .scroll-element,
.scrollbar-inner > .scroll-element div {
  border: none;
  margin: 0;
  padding: 0;
  position: absolute;
  z-index: 10;
}
.scrollbar-inner > .scroll-element div {
  display: block;
  height: 100%;
  left: 0;
  top: 0;
  width: 100%;
}
.scrollbar-inner > .scroll-element.scroll-x {
  bottom: 2px;
  height: 3px;
  left: 0;
  width: 100%;
}
.scrollbar-inner > .scroll-element.scroll-y {
  height: 100%;
  right: 2px;
  top: 0;
  width: 3px;
}
.scrollbar-inner > .scroll-element .scroll-element_outer {
  overflow: hidden;
}
.scrollbar-inner > .scroll-element .scroll-element_track,
.scrollbar-inner > .scroll-element .scroll-bar {
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
  filter: alpha(opacity=40);
  opacity: 0.4;
}
.scrollbar-inner > .scroll-element .scroll-element_track {
  background-color: #e0e0e0;
}
.scrollbar-inner > .scroll-element .scroll-bar {
  background-color: <?=$color_primary?>;
}
.scrollbar-inner > .scroll-element:hover .scroll-bar {
  background-color: <?=$color_primary?>;
}
.scrollbar-inner > .scroll-element.scroll-draggable .scroll-bar {
  background-color: <?=$color_primary?>;
}
/* update scrollbar offset if both scrolls are visible */
.scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_track {
  left: -3px;
}
.scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_track {
  top: -3px;
}
.scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size {
  left: -3px;
}
.scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size {
  top: -3px;
}
/*************** SIMPLE OUTER SCROLLBAR ***************/
.worldstateLeft > .scroll-element,
.worldstateLeft > .scroll-element div {
  border: none;
  margin: 0;
  padding: 0;
  position: absolute;
  z-index: 10;
}
.worldstateLeft > .scroll-element {
  background-color: transparent;
}
.worldstateLeft > .scroll-element div {
  display: block;
  height: 100%;
  left: 0;
  top: 0;
  width: 100%;
}
.worldstateLeft > .scroll-element.scroll-x {
  bottom: 0;
  height: 3px;
  left: 0;
  width: 100%;
}
.worldstateLeft > .scroll-element.scroll-y {
  height: 100%;
  right: 0;
  top: 0;
  width: 3px;
}
.worldstateLeft > .scroll-element.scroll-x .scroll-element_outer {
  height: 3px;
  top: 2px;
}
.worldstateLeft > .scroll-element.scroll-y .scroll-element_outer {
  width: 3px;
}
.worldstateLeft > .scroll-element .scroll-element_outer {
  overflow: hidden;
}
.worldstateLeft > .scroll-element .scroll-element_track {
  background-color: <?=$color_background4?>;
}
.worldstateLeft > .scroll-element .scroll-bar {
  background-color: <?=$color_primary?>;
}
.worldstateLeft > .scroll-element .scroll-bar:hover {
  background-color: <?=$color_primary?>;
}
.worldstateLeft > .scroll-element.scroll-draggable .scroll-bar {
  background-color: <?=$color_primary?>;
}
/* scrollbar height/width & offset from container borders */
.worldstateLeft > .scroll-content.scroll-scrolly_visible {
  left: -3px;
  margin-left: 3px;
}
.worldstateLeft > .scroll-content.scroll-scrollx_visible {
  top: -3px;
  margin-top: 3px;
}
.worldstateLeft > .scroll-element.scroll-x .scroll-bar {
  min-width: 10px;
}
.worldstateLeft > .scroll-element.scroll-y .scroll-bar {
  min-height: 10px;
}
/* update scrollbar offset if both scrolls are visible */
.worldstateLeft > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_track {
  left: -13px;
}
.worldstateLeft > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_track {
  top: -13px;
}
.worldstateLeft > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size {
  left: -13px;
}
.worldstateLeft > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size {
  top: -13px;
}
