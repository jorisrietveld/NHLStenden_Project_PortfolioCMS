<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 05-01-2017 07:59
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Security;


class Encryption
{
    public function getSecretKey(  )
    {
        return \Sodium\randombytes_buf(\Sodium\CRYPTO_SECRETBOX_KEYBYTES);
    }

    public function encryptDatabaseData( string $databaseData )
    {

        $nonce = \Sodium\randombytes_buf(\Sodium\CRYPTO_SECRETBOX_NONCEBYTES);
        //$ciphertext = \Sodium\crypto_secretbox('test', $nonce, $key);
    }

    public function decryptDatabaseData( string $databaseData, string $nonce, string $decryptionKey )
    {
        
    }
}