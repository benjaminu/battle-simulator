<?php

namespace BattleSimulator\Combatant;

/**
 * Brute class.
 *
 * @package   BattleSimulator
 * @author    Benjamin Ugbene <benjamin.ugbene@googlemail.com>
 * @copyright 2013 Benjamin Ugbene
 * @license   MIT
 */
class Brute extends Combatant
{
    /**
     * {@inheritDoc}
     */
    protected $type = 'Brute';

    /**
     * {@inheritDoc}
     */
    protected $healthMinimum = 90;

    /**
     * {@inheritDoc}
     */
    protected $healthMaximum = 100;

    /**
     * {@inheritDoc}
     */
    protected $strengthMinimum = 65;

    /**
     * {@inheritDoc}
     */
    protected $strengthMaximum = 75;

    /**
     * {@inheritDoc}
     */
    protected $defenceMinimum = 40;

    /**
     * {@inheritDoc}
     */
    protected $defenceMaximum = 50;

    /**
     * {@inheritDoc}
     */
    protected $speedMinimum = 40;

    /**
     * {@inheritDoc}
     */
    protected $speedMaximum = 65;

    /**
     * {@inheritDoc}
     */
    protected $luckMinimum = 0.3;

    /**
     * {@inheritDoc}
     */
    protected $luckMaximum = 0.35;

    /**
     * {@inheritDoc}
     */
    protected $skillLevel = 2;

    /**
     * {@inheritDoc}
     */
    protected $skill = self::SKILL_STUNNING_BLOW;

    /**
     * {@inheritDoc}
     */
    protected function useSpecialSkill(Combatant $opponent)
    {
        $opponent->loseNextTurn(true);
        $this->ordinaryAttack($opponent);

        $this->displayMessage(
            $this->getName()."'s strike's ".$opponent->getName()." with his ".
            self::$skills[$this->skill]['name']." special skill. ".
            $opponent->getName()."'s will have to miss a turn, and his health is down to ".
            $opponent->getHealth()."%."
        );
    }
}
