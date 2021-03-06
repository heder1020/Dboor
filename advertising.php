<?php
define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'advertising.php' );
class GPage extends SecureGamePage
{
    var $isAdmin = FALSE;
    var $Advertisings = array( );
    var $pageSize = 20;
    var $pageIndex = null;
    var $pageCount = null;
    function GPage( )
    {
        parent::securegamepage();
        $this->viewFile        = 'advertising.phtml';
        $this->contentCssClass = 'player';
    }
    function load( )
    {
        parent::load();
        $this->pageIndex = ( ( isset( $_GET['p'] ) && is_numeric( $_GET['p'] ) ) ? intval( $_GET['p'] ) : 0 );
        $this->isAdmin   = $this->data['player_type'] == PLAYERTYPE_ADMIN;
        if ( !$this->isAdmin ) {
            exit( 0 );
            return null;
        }
        $m               = new AdvertisingModel();
        $rowsCount       = $m->getAdvertisingCount();
        $this->pageCount = ( 0 < $rowsCount ? ceil( $rowsCount / $this->pageSize ) : 1 );
        if ( ( isset( $_GET['DAdv'] ) && !empty( $_GET['DAdv'] ) ) ) {
            $advID = mysql_real_escape_string( trim( $_GET['DAdv'] ) );
            if ( $advID != '' ) {
                $m->DeleteAdvertising( $advID );
                $m->dispose();
                $this->redirect( 'advertising.php' );
                return null;
            }
        }
        if ( $this->isPost() ) {
            $post          = array( );
            $type          = ( ( isset( $_POST['do'] ) && $_POST['do'] != 'add' ) ? 'edit' : 'add' );
            $post['name']  = ( ( isset( $_POST['name'] ) && $_POST['name'] != '' ) ? mysql_real_escape_string( trim( $_POST['name'] ) ) : 'SPSLink.NET' );
            $post['url']   = ( ( isset( $_POST['url'] ) && $_POST['url'] != '' ) ? mysql_real_escape_string( trim( $_POST['url'] ) ) : 'http://www.spslink.net' );
            $post['cat']   = ( ( isset( $_POST['cat'] ) && $_POST['cat'] != '' ) ? mysql_real_escape_string( trim( $_POST['cat'] ) ) : '1' );
            $post['image'] = ( ( isset( $_POST['image'] ) && $_POST['image'] != '' ) ? mysql_real_escape_string( trim( $_POST['image'] ) ) : 'assets/default/img/characters.png' );
            $ext           = strtolower( end( explode( '.', mysql_real_escape_string( trim( $post['image'] ) ) ) ) );
            $post['type']  = ( $ext == 'swf' ? 'flash' : 'image' );
            $post['ID']    = ( ( isset( $_POST['ID'] ) && $_POST['ID'] != '' ) ? mysql_real_escape_string( trim( $_POST['ID'] ) ) : 0 );
            $m->Advertising( $post, $type );
            $m->dispose();
            $this->redirect( 'advertising.php' );
            return null;
        }
        $this->Advertisings = $m->GetAdvertisings( $this->pageIndex, $this->pageSize );
        $m->dispose();
    }
    function getNextLink( )
    {
        $text = text_nextpage_lang . ' »';
        if ( $this->pageIndex + 1 == $this->pageCount ) {
            return $text;
        }
        $link = 'p=' . ( $this->pageIndex + 1 );
        $link = 'advertising.php?' . $link;
        return '<a href="' . $link . '">' . $text . '</a>';
    }
    function getPreviousLink( )
    {
        $text = '« ' . text_prevpage_lang;
        if ( $this->pageIndex == 0 ) {
            return $text;
        }
        $link = '';
        if ( 0 < $this->pageIndex ) {
            if ( $link != '' ) {
                $link .= '&';
            }
            $link .= 'p=' . ( $this->pageIndex - 1 );
        }
        if ( $link != '' ) {
            $link = '?' . $link;
        }
        $link = 'advertising.php' . $link;
        return '<a href="' . $link . '">' . $text . '</a>';
    }
}
$p = new GPage();
$p->run();
?>