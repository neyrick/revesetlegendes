<?php
/**
 * DokuWiki Plugin Dynamic Skin
 *
 * @author Eric Demorsy <dev@neyrick.fr>
 */
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'admin.php');

/**
 * All DokuWiki plugins to extend the admin function
 * need to inherit from this class
 */
class admin_plugin_dynskin extends DokuWiki_Admin_Plugin {

    /**
     * Constructor
     */
    function admin_plugin_dynskin() {
        $this->setupLocale();
        $this->config = DOKU_CONF.'dynskin.conf';
    }

    /**
     * return sort order for position in admin menu
     */
    function getMenuSort() {
        return 400;
    }

    /**
     * handle user request
     */
    function handle() {
        $data = array();
        $nsdata = array();

        if(!empty($_REQUEST['namespace'])) {
            $namespace = $_REQUEST['namespace'];

            if($_REQUEST['act'] == 'add') {
                if(@file_exists($this->config)) {
                    $data = unserialize(io_readFile($this->config, false));
                    $nsdata['color1'] = $_REQUEST['color1'];
                    $nsdata['color2'] = $_REQUEST['color2'];
                    $data[$namespace] = $nsdata;
                    io_saveFile($this->config, serialize($data));
                } else {
                    $nsdata['color1'] = $_REQUEST['color1'];
                    $nsdata['color2'] = $_REQUEST['color2'];
                    $data[$namespace] = $nsdata;
                    io_saveFile($this->config, serialize($data));
                }
            }

            if($_REQUEST['act'] == 'del') {
                $data = unserialize(io_readFile($this->config, false));
                unset($data[$namespace]);
                io_saveFile($this->config, serialize($data));
            }
        }
    }

    /**
     * output appropriate html
     */
    function html() {
        global $lang;
        global $conf;
        global $ID;

        print '<div id="plugin__dynskin">';
        print $this->locale_xhtml('intro');

        $result = array();
        $search_opts = array(
               'listdirs' => true,
               'listfiles' => false,
               'depth' => 1
               );

        $nslist = array();
	search($result,$conf['datadir'],'search_universal',$search_opts);
        $excluded = explode(",", $this->getConf('excludedNamespaces'));
        foreach($result as $item){
            if (!in_array($item['id'], $excluded)) {
              $nslist[] = $item['id'];
            }
        }

        $form = new Doku_Form(array());
        $form->startFieldSet($this->getLang('addAction'));
        $form->addHidden('id',$ID);
        $form->addHidden('do','admin');
        $form->addHidden('page','dynskin');
        $form->addHidden('act','add');
        $form->addElement(form_makeOpenTag('p'));
        $form->addElement(form_makeListboxField('namespace',$nslist,'',$this->getLang('namespace')));
        $form->addElement(form_makeCloseTag('p'));
        $form->addElement(form_makeOpenTag('p'));
        $form->addElement(form_makeTextField('color1','',$this->getLang('color1')));
        $form->addElement(form_makeCloseTag('p'));
        $form->addElement(form_makeOpenTag('p'));
        $form->addElement(form_makeTextField('color2','',$this->getLang('color2')));
        $form->addElement(form_makeCloseTag('p'));
        $form->addElement(form_makeButton('submit','',$lang['btn_save']));
        $form->endFieldSet();
        $form->printForm();

        if(@file_exists($this->config)) {
            $data = unserialize(io_readFile($this->config, false));

            if(!empty($data)) {
                echo '<br/><table class="inline">' . DOKU_LF;
                echo '  <tr>' . DOKU_LF;
                echo '    <th>' . $this->getLang('namespace') . '</th>' . DOKU_LF;
                echo '    <th>' . $this->getLang('color1') . '</th>' . DOKU_LF;
                echo '    <th>' . $this->getLang('color2') . '</th>' . DOKU_LF;
                echo '    <th>' . $this->getLang('action') . '</th>' . DOKU_LF;
                echo '  </tr>' . DOKU_LF;
                foreach($data as $key => $value) {
                    echo '  <tr>' . DOKU_LF;
                    echo '    <td>' . $key . '</td>' . DOKU_LF;
                    echo '    <td>' . $value['color1'] . '</td>' . DOKU_LF;
                    echo '    <td>' . $value['color2'] . '</td>' . DOKU_LF;
                    echo '    <td>' . DOKU_LF;

                    $form = new Doku_Form(array());
                    $form->addHidden('do','admin');
                    $form->addHidden('page','dynskin');
                    $form->addHidden('act','del');
                    $form->addHidden('id',$ID);
                    $form->addHidden('namespace',$key);
                    $form->addElement(form_makeButton('submit','',$lang['btn_delete']));
                    $form->printForm();

                    echo '    </td>' . DOKU_LF;
                    echo '  </tr>' . DOKU_LF;
                }
                echo '</table>' . DOKU_LF;
            }
        }
        print '</div>';
    }

}

