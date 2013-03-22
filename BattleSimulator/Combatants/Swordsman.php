<?php

namespace BattleSimulator\Combatants;

/**
 * Swordsman class.
 *
 * @category  Combatants
 * @package   BattleSimulator
 * @author    Benjamin Ugbene <benjamin.ugbene@googlemail.com>
 * @copyright 2013 Benjamin Ugbene
 * @license   MIT
 */
class Swordsman extends Combatant
{
    /**
     * {@inheritDoc}
     */
    protected $type = 'Swordsman';

    /**
     * {@inheritDoc}
     */
    protected $healthMinimum = 40;

    /**
     * {@inheritDoc}
     */
    protected $healthMaximum = 60;

    /**
     * {@inheritDoc}
     */
    protected $strengthMinimum = 60;

    /**
     * {@inheritDoc}
     */
    protected $strengthMaximum = 70;

    /**
     * {@inheritDoc}
     */
    protected $defenceMinimum = 20;

    /**
     * {@inheritDoc}
     */
    protected $defenceMaximum = 30;

    /**
     * {@inheritDoc}
     */
    protected $speedMinimum = 90;

    /**
     * {@inheritDoc}
     */
    protected $speedMaximum = 100;

    /**
     * {@inheritDoc}
     */
    protected $luckMinimum = 0.3;

    /**
     * {@inheritDoc}
     */
    protected $luckMaximum = 0.5;

    /**
     * {@inheritDoc}
     */
    protected $skillLevel = 5;

    /**
     * {@inheritDoc}
     */
    protected $skill = self::SKILL_LUCKY_STRIKE;

    /**
     * {@inheritDoc}
     */
    protected function useSpecialSkill(Combatant $opponent)
    {
        $damage = ($this->getStrength() * 2) - $opponent->getDefence();

        $opponent->reduceHealth($damage);

        $this->displayMessage(
            $this->getName()."'s strike's ".$opponent->getName()." with his ".
            self::$skills[$this->skill]['name']." special skill. ".
            $opponent->getName()."'s health is down to ".$opponent->getHealth()."%."
        );
    }
}