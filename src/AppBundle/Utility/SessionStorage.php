<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 26/11/2016
 * Time: 09:46
 */

namespace AppBundle\Utility;


class SessionStorage
{
    public $id; // ID univoco
    public $length; // Numero di elementi
    protected $_token = 'w9:FS)NU_Q>N{9{+dU>prHfZ';

    public function __construct() {
        $this->id = md5( $_SERVER['HTTP_USER_AGENT'] . $this->_token );
        $this->length = 0;
    }

    public function initialize() { // Crea la sessione
        session_start();
        $_SESSION['data'] = array();
        $_SESSION['id'] = $this->id;
    }

    public function setItem( $key, $value ) {
        $_SESSION['data'][$key] = $value; // Imposta una chiave e un valore
        $this->_setLength(); // Aggiorna il numero di elementi

    }

    public function removeItem( $key ) {
        unset( $_SESSION['data'][$key] ); // Rimuove una chiave
        $this->_setLength();
    }

    public function clear() { // Elimina la sessione e i dati
        session_destroy();
        $_SESSION = array();
        $this->length = 0;
        $this->id = '';
    }

    public function hasItem( $key ) { // Verifica che una chiave sia presente
        if( array_key_exists( $key, $_SESSION['data'] ) ) {
            return true;
        } else {
            return false;
        }
    }

    private function _setLength() {
        $this->length = count( $_SESSION['data'] );
    }
}