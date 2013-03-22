<?php

namespace BattleSimulator\Combatants;

/**
 * Grappler class.
 *
 * @category  Combatants
 * @package   BattleSimulator
 * @author    Benjamin Ugbene <benjamin.ugbene@googlemail.com>
 * @copyright 2013 Benjamin Ugbene
 * @license   MIT
 */
class Grappler extends Combatant
{
    /**
     * {@inheritDoc}
     */
    protected $type = 'Grappler';

    /**
     * {@inheritDoc}
     */
    protected $healthMinimum = 60;

    /**
     * Maximum health level.
     *
     * @var integer
     */
    protected $healthMaximum = 100;

    /**
     * {@inheritDoc}
     */
    protected $strengthMinimum = 75;

    /**
     * {@inheritDoc}
     */
    protected $strengthMaximum = 80;

    /**
     * {@inheritDoc}
     */
    protected $defenceMinimum = 35;

    /**
     * {@inheritDoc}
     */
    protected $defenceMaximum = 40;

    /**
     * {@inheritDoc}v
     */
    protected $speedMinimum = 60;

    /**
     * {@inheritDoc}
     */
    protected $speedMaximum = 80;

    /**
     * {@inheritDoc}
     */
    protected $luckMinimum = 0.3;

    /**
     * {@inheritDoc}
     */
    protected $luckMaximum = 0.4;

    /**
     * {@inheritDoc}
     */
    protected $skillLevel = 4;

    /**
     * {@inheritDoc}
     */
    protected $skill = self::SKILL_COUNTER_ATTACK;

    /**
     * {@inheritDoc}
     */
    protected function useSpecialSkill(Combatant $opponent)
    {
        $opponent->reduceHealth(10);

        $this->displayMessage(
            $this->getName()." does not just dodge ".$opponent->getName()."'s attack, but responds with his ".
            self::$skills[$this->skill]['name']." special skill. ".
            $opponent->getName()."'s health is down to ".$opponent->getHealth()."%."
        );
    }
}
