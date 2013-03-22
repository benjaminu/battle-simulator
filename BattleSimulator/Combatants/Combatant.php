<?php

namespace BattleSimulator\Combatants;

/**
 * Combatant class.
 *
 * @category  Combatants
 * @package   BattleSimulator
 * @author    Benjamin Ugbene <benjamin.ugbene@googlemail.com>
 * @copyright 2013 Benjamin Ugbene
 * @license   MIT
 */
abstract class Combatant
{
    /**
     * Minimum character length.
     *
     * @var integer
     */
    const NAME_MINIMUM_LENGTH = 1;

    /**
     * Maximum character length.
     *
     * @var integer
     */
    const NAME_MAXIMUM_LENGTH = 30;

    /**
     * Minimum health level possible.
     *
     * @var integer
     */
    const HEALTH_MINIMUM_POSSIBLE = 0;

    /**
     * Maximum health level possible.
     *
     * @var integer
     */
    const HEALTH_MAXIMUM_POSSIBLE = 100;

    /**
     * Minimum strength level possible.
     *
     * @var integer
     */
    const STRENGTH_MINIMUM_POSSIBLE = 0;

    /**
     * Maximum strength level possible.
     *
     * @var integer
     */
    const STRENGTH_MAXIMUM_POSSIBLE = 100;

    /**
     * Minimum defence level possible.
     *
     * @var integer
     */
    const DEFENCE_MINIMUM_POSSIBLE = 0;

    /**
     * Maximum defence level possible.
     *
     * @var integer
     */
    const DEFENCE_MAXIMUM_POSSIBLE = 100;

    /**
     * Minimum speed level possible.
     *
     * @var integer
     */
    const SPEED_MINIMUM_POSSIBLE = 0;

    /**
     * Maximum speed level possible.
     *
     * @var integer
     */
    const SPEED_MAXIMUM_POSSIBLE = 100;

    /**
     * Minimum luck level possible.
     *
     * @var integer
     */
    const LUCK_MINIMUM_POSSIBLE = 0;

    /**
     * Maximum luck level possible.
     *
     * @var integer
     */
    const LUCK_MAXIMUM_POSSIBLE = 1;

    /**
     * Luck strike skill option.
     *
     * @var string
     */
    const SKILL_LUCKY_STRIKE = 'lucky-strike';

    /**
     * Stunning blow skill option.
     *
     * @var string
     */
    const SKILL_STUNNING_BLOW = 'stunning-blow';

    /**
     * Counter attack skill option.
     *
     * @var string
     */
    const SKILL_COUNTER_ATTACK = 'counter-attack';

    /**
     * Offensive skill type option.
     *
     * @var string
     */
    const SKILL_TYPE_OFFENSIVE = 'offensive';

    /**
     * Defensive skill type option.
     *
     * @var string
     */
    const SKILL_TYPE_DEFENSIVE = 'defensive';

    /**
     * Available skill oprions.
     *
     * @var integer
     */
    public static $skills = array(
        self::SKILL_LUCKY_STRIKE => array(
            'name' => 'Lucky Strike',
            'type' => self::SKILL_TYPE_OFFENSIVE,
        ),
        self::SKILL_STUNNING_BLOW => array(
            'name' => 'Stunning Blow',
            'type' => self::SKILL_TYPE_OFFENSIVE,
        ),
        self::SKILL_COUNTER_ATTACK => array(
            'name' => 'Counter Attack',
            'type' => self::SKILL_TYPE_DEFENSIVE,
        ),
    );

    /**
     * Type of combatant.
     *
     * @var string
     */
    protected $type = __CLASS__;

    /**
     * Combatant's name
     *
     * @var string
     */
    protected $name;

    /**
     * Combatant's health level.
     * Amount of health remaining.
     *
     * @var integer
     */
    protected $health;

    /**
     * Minimum health level.
     *
     * @var integer
     */
    protected $healthMinimum;

    /**
     * Maximum health level.
     *
     * @var integer
     */
    protected $healthMaximum;

    /**
     * Combatant's strength level.
     * Damage done when attacking.
     *
     * @var integer
     */
    protected $strength;

    /**
     * Minimum strength level.
     *
     * @var integer
     */
    protected $strengthMinimum;

    /**
     * Maximum strength level.
     *
     * @var integer
     */
    protected $strengthMaximum;

    /**
     * Minimum defence level.
     *
     * @var integer
     */
    protected $defenceMinimum;

    /**
     * Maximum defence level.
     *
     * @var integer
     */
    protected $defenceMaximum;

    /**
     * Combatant's defence level.
     * Damage reduction during defence of an attack.
     *
     * @var integer
     */
    protected $defence;

    /**
     * Combatant's speed level.
     * Determines attack order.
     *
     * @var integer
     */
    protected $speed;

    /**
     * Minimum speed level.
     *
     * @var integer
     */
    protected $speedMinimum;

    /**
     * Maximum speed level.
     *
     * @var integer
     */
    protected $speedMaximum;

    /**
     * Combatant's luck level.
     * Affects combatant's ability to dodge an sttack.
     *
     * @var float
     */
    protected $luck;

    /**
     * Minimum luck level.
     *
     * @var float
     */
    protected $luckMinimum;

    /**
     * Maximum luck level.
     *
     * @var float
     */
    protected $luckMaximum;

    /**
     * Ability to use special skill.
     *
     * @var float
     */
    protected $skillLevel;

    /**
     * Type of special skill.
     *
     * @var string
     */
    protected $skill;

    /**
     * Indicates whether or not battler will lose turn.
     *
     * @var boolean
     */
    protected $loseTurn = false;

    /**
     * Constructor.
     *
     * @param string $name Combatant's name.
     *
     * @var float
     */
    public function __construct($name)
    {
        $this->setName(ucwords(strtolower($name)));
        $this->init();
    }

    /**
     * Returns combatant type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns combatant's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->type.' '.$this->name;
    }

    /**
     * Sets combatant's name.
     *
     * @param string $name Combatant's name.
     *
     * @return string
     */
    public function setName($name)
    {
        if (strlen($name) < self::NAME_MINIMUM_LENGTH || strlen($name) > self::NAME_MAXIMUM_LENGTH) {
            throw new \RuntimeException(
                "Combatant's name must range from ".self::NAME_MINIMUM_LENGTH." to ".
                self::NAME_MINIMUM_LENGTH." characters"
            );
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Returns combatant's health.
     *
     * @return integer
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Sets combatant's health.
     *
     * @param integer $health Combatant's health.
     *
     * @return Combatant
     */
    public function setHealth($health)
    {
        if ($health < self::HEALTH_MINIMUM_POSSIBLE || $health > self::HEALTH_MAXIMUM_POSSIBLE) {
            throw new \RuntimeException(
                "Combatant's heatlh level must range from ".self::HEALTH_MINIMUM_POSSIBLE." to ".
                self::HEALTH_MAXIMUM_POSSIBLE
            );
        } elseif ($health < $this->healthMinimum || $health > $this->healthMaximum) {
            throw new \RuntimeException(
                get_called_class()."'s health level must range from ".$this->healthMinimum." to ".
                $this->healthMaximum
            );
        } elseif (! is_int($health)) {
            throw new \RuntimeException("Combatant's heatlh level must be an integer. Provided:".$health);
        }

        $this->health = $health;

        return $this;
    }

    /**
     * Returns combatant's strength.
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Sets combatant's strength.
     *
     * @param integer $strength Combatant's strength.
     *
     * @return Combatant
     */
    public function setStrength($strength)
    {
        if ($strength < self::STRENGTH_MINIMUM_POSSIBLE || $strength > self::STRENGTH_MAXIMUM_POSSIBLE) {
            throw new \RuntimeException(
                "Combatant's strength level must range from ".self::STRENGTH_MINIMUM_POSSIBLE." to ".
                self::STRENGTH_MAXIMUM_POSSIBLE
            );
        } elseif ($strength < $this->strengthMinimum || $strength > $this->strengthMaximum) {
            throw new \RuntimeException(
                get_called_class()."'s strength level must range from ".$this->strengthMinimum." to ".
                $this->strengthMaximum
            );
        } elseif (! is_int($strength)) {
            throw new \RuntimeException("Combatant's strength level must be an integer. Provided:".$strength);
        }

        $this->strength = $strength;

        return $this;
    }

    /**
     * Returns combatant's defence.
     *
     * @return integer
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * Sets combatant's defence.
     *
     * @param integer $defence Combatant's defence.
     *
     * @return Combatant
     */
    public function setDefence($defence)
    {
        if ($defence < self::DEFENCE_MINIMUM_POSSIBLE || $defence > self::DEFENCE_MAXIMUM_POSSIBLE) {
            throw new \RuntimeException(
                "Combatant's defence level must range from ".self::DEFENCE_MINIMUM_POSSIBLE." to ".
                self::DEFENCE_MAXIMUM_POSSIBLE
            );
        } elseif ($defence < $this->defenceMinimum || $defence > $this->defenceMaximum) {
            throw new \RuntimeException(
                get_called_class()."'s defence level must range from ".$this->defenceMinimum." to ".
                $this->defenceMaximum
            );
        } else if (! is_int($defence)) {
            throw new \RuntimeException("Combatant's defence level must be an integer. Provided:".$defence);
        }

        $this->defence = $defence;

        return $this;
    }

    /**
     * Returns combatant's speed.
     *
     * @return integer
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Sets combatant's speed.
     *
     * @param integer $speed Combatant's speed.
     *
     * @return Combatant
     */
    public function setSpeed($speed)
    {
        if ($speed < self::SPEED_MINIMUM_POSSIBLE || $speed > self::SPEED_MAXIMUM_POSSIBLE) {
            throw new \RuntimeException(
                "Combatant's speed level must range from ".self::SPEED_MINIMUM_POSSIBLE." to ".
                self::SPEED_MAXIMUM_POSSIBLE
            );
        } elseif ($speed < $this->speedMinimum || $speed > $this->speedMaximum) {
            throw new \RuntimeException(
                get_called_class()."'s speed level must range from ".$this->speedMinimum." to ".
                $this->speedMaximum
            );
        } elseif (! is_int($speed)) {
            throw new \RuntimeException("Combatant's speed level must be an integer. Provided:".$speed);
        }

        $this->speed = $speed;

        return $this;
    }

    /**
     * Returns combatant's luck.
     *
     * @return float
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * Sets combatant's luck.
     *
     * @param float $luck Combatant's luck.
     *
     * @return Combatant
     */
    public function setLuck($luck)
    {
        if ($luck < self::LUCK_MINIMUM_POSSIBLE || $luck > self::LUCK_MAXIMUM_POSSIBLE) {
            throw new \RuntimeException(
                "Combatant's luck level must range from ".self::LUCK_MINIMUM_POSSIBLE." to ".
                self::LUCK_MAXIMUM_POSSIBLE
            );
        } elseif ($luck < $this->luckMinimum || $luck > $this->luckMaximum) {
            throw new \RuntimeException(
                get_called_class()."'s luck level must range from ".$this->luckMinimum." to ".
                $this->luckMaximum
            );
        }

        $this->luck = $luck;

        return $this;
    }

    /**
     * Tells combatant to lose next turn.
     *
     * @return void
     */
    public function loseNextTurn()
    {
        $this->loseTurn = true;
    }

    /**
     * Executes combatant's attack againt opponent.
     *
     * @param Combatant $opponent Combatant being attacked.
     *
     * @return boolean
     */
    public function launchAttack(Combatant $opponent)
    {
        if ($this->loseTurn) {
            $this->displayMessage($this->getName().' loses his turn.');
            $this->loseTurn = false;

            return false;
        }

        if ($opponent->dodgesAttack($this)) {
            return false;
        }

        if (
            self::$skills[$this->skill]['type'] == self::SKILL_TYPE_OFFENSIVE &&
            $this->canUseSpecialSkill()
        ) {
            $this->useSpecialSkill($opponent);
        } else {
            $this->ordinaryAttack($opponent);
            $this->displayMessage(
                $this->getName()."'s attack succeeds. ".
                $opponent->getName()."'s health is down to ".$opponent->getHealth()."%."
            );
        }

        return true;
    }

    /**
     * Checks to see if combatant dodges opponent's attack.
     *
     * @param Combatant $opponent Combatant doing the attacking.
     *
     * @return boolean
     */
    public function dodgesAttack(Combatant $opponent)
    {
        if (! $this->dodgeAttack()) {
            return false;
        }

        $this->displayMessage($this->getName().' dodges '.$opponent->getName().'\'s attack.');

        if (
            self::$skills[$this->skill]['type'] == self::SKILL_TYPE_DEFENSIVE &&
            $this->canUseSpecialSkill()
        ) {
            $this->useSpecialSkill($opponent);
        }

        return true;
    }

    /**
     * Used to reduce combatant's health in the event of an attck.
     *
     * @param integer $damage Damage done to combatant's health.
     *
     * @return Combatant
     */
    public function reduceHealth($damage)
    {
        $this->health = $this->health - $damage;

        if ($this->health <= 0) {
            $this->health = 0;
        }

        return $this;
    }

    /**
     * Returns combatant's statistics.
     *
     * @return string
     */
    public function getStatistics()
    {
        return $this->name.":\n".
            "Designation: ".$this->getType()."\n".
            "Health: ".$this->getHealth()."\n".
            "Strength: ".$this->getStrength()."\n".
            "Defence: ".$this->getDefence()."\n".
            "Speed: ".$this->getSpeed()."\n".
            "Luck: ".$this->getLuck()."\n".
            "Special skill: ".self::$skills[$this->skill]['name']."\n";
    }

    /**
     * Magic string function.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getStatistics();
    }

    /**
     * Use special skill against opponent.
     *
     * @param Combatant $opponent Combatant being attacked.
     *
     * @return void
     */
    abstract protected function useSpecialSkill(Combatant $opponent);

    /**
     * Initialize combatant's attributes.
     *
     * @return void
     */
    protected function init()
    {
        $this->initAttribute('health');
        $this->initAttribute('strength');
        $this->initAttribute('defence');
        $this->initAttribute('speed');
        $this->initLuck();
    }

    /**
     * Initialize combatant's attributes.
     *
     * @param string $attribute Name of attribute to be initialized.
     *
     * @return void
     */
    protected function initAttribute($attribute)
    {
        $minimum = strtolower($attribute).'Minimum';
        $maximum = strtolower($attribute).'Maximum';
        $setter  = 'set'.ucfirst(strtolower($attribute));

        $value = rand($this->$minimum, $this->$maximum);
        $this->$setter($value);
    }

    /**
     * Initialize combatant's luck attribute.
     *
     * @return void
     */
    protected function initLuck()
    {
        $minimum = $this->luckMinimum * 100;
        $maximum = $this->luckMaximum * 100;

        $value = rand($minimum, $maximum);
        $this->setLuck($value / 100);
    }

    /**
     * Checks if combatant will execute special skill.
     *
     * @return boolean
     */
    protected function canUseSpecialSkill()
    {
        $marker  = $this->getMarker();

        if ($marker <= $this->skillLevel) {
            return true;
        }

        return false;
    }

    /**
     * Attempt to dodge opponent's attack.
     *
     * @return boolean
     */
    protected function dodgeAttack()
    {
        $marker  = $this->getMarker();

        if ($marker <= ($this->getLuck() * 100)) {
            return true;
        }

        return false;
    }

    /**
     * Returns random integer between 0 an 100.
     *
     * @return integer
     */
    protected function getMarker()
    {
        return rand(0, 100);
    }

    /**
     * Perform normal attack against opponent.
     *
     * @param Combatant $opponent Combatant being attacked.
     *
     * @return void
     */
    protected function ordinaryAttack(Combatant $opponent)
    {
        $damage = $this->getStrength() - $opponent->getDefence();

        $opponent->reduceHealth($damage);
    }

    /**
     * Prints text to screen.
     *
     * @param string $message Message to print to screen.
     *
     * @return void
     */
    protected function displayMessage($message)
    {
        fwrite(STDOUT, "{$message}\n");
    }
}
