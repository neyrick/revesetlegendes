<?php
    if(!defined('DOKU_INC')) die();
     
     
    class action_plugin_relactions extends DokuWiki_Action_Plugin {
     
        /**
         * Register its handlers with the DokuWiki's event controller
         */
        public function register(Doku_Event_Handler $controller) {
            $controller->register_hook('TEMPLATE_PAGETOOLS_DISPLAY', 'BEFORE', $this,
                                       '_hookPagetools');
        }
     
        public function _hookPagetools(&$event, $param) {
            $event->data['items'][] = '<li><a class="action syntax" target="_blank" title="Guide de syntaxe" rel="nofollow" href="/doku.php?id=wiki:syntax"><span>Guide de syntaxe</span></a></li>';
            $event->data['items'][] = '<li><a class="action sandbox" target="_blank" title="Bac à sable" rel="nofollow" href="/doku.php?id=wiki:sandbox"><span>Bac à sable</span></a></li>';
        }
    }

?>
