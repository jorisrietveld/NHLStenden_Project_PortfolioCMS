<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 22-12-2016 05:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Entity;


class GuestBookMessage
{
    protected $id;
    protected $sender;
    protected $title;
    protected $message;
    protected $isAccepted;
    protected $user; // One guestBookMessage has one user.
}