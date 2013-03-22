<?php

namespace BattleSimulator;

use BattleSimulator\Combatants\Combatant;
use BattleSimulator\Combatants\Brute;
use BattleSimulator\Combatants\Swordsman;
use BattleSimulator\Combatants\Grappler;

/**
 * BattleSimulator class.
 *
 * @package   BattleSimulator
 * @author    Benjamin Ugbene <benjamin.ugbene@googlemail.com>
 * @copyright 2013 Benjamin Ugbene
 * @license   MIT
 */
class BattleSimulator
{
    /**
     * Number of battlers.
     *
     * @var string
     */
    const NUMBER_OF_BATTLERS = 2;

    /**
     * Number of rounds.
     * Note:
     * 15 rounds = 30 turns each.
     * One paragraph read 30 turns,
     * and another read 30 rounds,
     * I went with the first.
     *
     * @var string
     */
    const NUMBER_OF_ROUNDS = 15;

    /**
     * Types of combatants.
     *
     * @var string
     */
    private static $combatants = array(
        '\BattleSimulator\Combatants\Swordsman',
        '\BattleSimulator\Combatants\Brute',
        '\BattleSimulator\Combatants\Grappler',
    );

    /**
     * Title of game.
     *
     * @var string
     */
    private $gameTitle = 'BATTLE SIMULATOR 2013';

    /**
     * Winner of battle.
     *
     * @var Combatant
     */
    private $winner;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->welcomeMessage();
    }

    /**
     * Run simlation
     *
     * @return void
     */
    public function execute()
    {
        $this->doBattle($this->selectCombatants());
        $this->goodbyeMessage();
    }

    /**
     * Sets up combatants.
     *
     * @return array
     */
    private function selectCombatants()
    {
        $battlers = array();

        for ($i = 0; $i < self::NUMBER_OF_BATTLERS; $i++) {
            $this->displayMessage("Please enter a name for combatant #".($i + 1));
            $name = $this->getInput();

            try {
                $combatant    = $this->getCombatant();
                $battlers[$i] = new $combatant($name);
            } catch (\RuntimeException $e) {
                $this->displayMessage($e->getMessage());
                $i--;
            }
        }

        return $battlers;
    }

    /**
     * Initiates combatant battless.
     *
     * @param array $battlers Selected combatants
     *
     * @return void
     */
    private function doBattle(array $battlers)
    {
        $combatantsInAttackOrder = array();
        $this->introduceBattlers($battlers);
        for ($i = 0; $i <= self::NUMBER_OF_ROUNDS; $i++) {
            if ($i == self::NUMBER_OF_ROUNDS) {
                break;
            }

            $message = "\n-------------------------------------------\n";
            $message .= "Round #".($i + 1).". FIGHT!!!";
            $message .= "\n-------------------------------------------\n";

            $this->displayMessage($message);

            $combatants = $this->sortInAttackOrder($battlers[0], $battlers[1]);

            $combatants[0]->launchAttack($combatants[1]);
            if ($this->checkForWinner($combatants[0], $combatants[1])) {
                break;
            }

            $combatants[1]->launchAttack($combatants[0]);
            if ($this->checkForWinner($combatants[0], $combatants[1])) {
                break;
            }
        }

        $this->announceWinner();
    }

    /**
     * Prints text to screen.
     *
     * @param string $message Message to print to screen.
     *
     * @return void
     */
    private function displayMessage($message)
    {
        fwrite(STDOUT, "{$message}\n");
    }

    /**
     * Prints welcome message to screen.
     *
     * @return string
     */
    private function welcomeMessage()
    {
        $message = <<<EOD
===================================
****** {$this->gameTitle} ******
===================================
EOD;
        $this->displayMessage($message);
    }

    /**
     * Prints goodbye message to screen.
     *
     * @return string
     */
    private function goodbyeMessage()
    {
        $message = <<<EOD
-----------------------------------------------------------
GAME OVER!!
===========================================================
****************** {$this->gameTitle} ******************
===========================================================
Developer: Benjamin Ugbene <benjamin.ugbene@googlemail.com>
===========================================================
EOD;
        $this->displayMessage($message);
    }

    /**
     * Displays message introducing combatant's.
     *
     * @param array $battlers Selected combatants
     *
     * @return void
     */
    private function introduceBattlers(array $battlers)
    {
        $message = "\nThis is the fight you've all been wating for... Introducing; \n";

        foreach ($battlers as $combatant) {
            $message .= "===========================\n";
            $message .= (string) $combatant;
            $message .= "===========================\nand\n";
        }

        $message = rtrim($message, "and\n");

        $this->displayMessage($message);
    }

    /**
     * Displays message introducing combatant's.
     *
     * @return void
     */
    private function announceWinner()
    {
        $winner = $this->getWinner();

        $message = "\n================================================\n";

        if (! $winner) {
            $message .= "The battle ended in a tie.";
        } else {
            $message .= "The winner is... ".$winner->getName();
        }

        $message .= "\n================================================\n";

        $this->displayMessage($message);
    }

    /**
     * Get user input.
     *
     * @return string
     */
    private function getInput()
    {
        $input = trim(fgets(STDIN));

        return $input;
    }

    /**
     * Randomnly selects a type of combantant.
     *
     * @return string
     */
    private function getCombatant()
    {
        $upperLimit = count(static::$combatants)-1;
        $index      = rand(0, $upperLimit);

        return static::$combatants[$index];
    }

    /**
     * Sorts combatants in the order in which they will launch attacks.
     *
     * @param Combatant $battler1 Combatant #1
     * @param Combatant $battler2 Combatant #2
     *
     * @return array
     */
    private function sortInAttackOrder(Combatant $battler1, Combatant $battler2)
    {
        if (! ($battler1->getSpeed() >= $battler2->getSpeed())) {
            return array($battler2, $battler1);
        } else if ($battler1->getSpeed() > $battler2->getSpeed()) {
            return array($battler1, $battler2);
        } else {
            if ($battler1->getDefence() <= $battler2->getDefence()) {
                return array($battle1, $battler2);
            } else {
                return array($battler2, $battler1);
            }
        }
    }

    /**
     * Checks if a winner has emerged.
     *
     * @param Combatant $battler1 Combatant #1
     * @param Combatant $battler2 Combatant #2
     *
     * @return boolean
     */
    private function checkForWinner(Combatant $battler1, Combatant $battler2)
    {
        if ($battler1->getHealth() == 0) {
            $this->setWinner($battler2);

            return true;
        } else if ($battler2->getHealth() == 0) {
            $this->setWinner($battler1);

            return true;
        }

        return false;
    }

    /**
     * Returns winner of battle.
     *
     * @return Combatant
     */
    private function getWinner()
    {
        return $this->winner;
    }

    /**
     * Checks if a winner has emerged.
     *
     * @param Combatant $winner Victorious combatant.
     *
     * @return void
     */
    private function setWinner(Combatant $winner)
    {
        $this->winner = $winner;
    }
}
