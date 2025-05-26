<?php
/**
 * Fgsl Genetic Algorithm
 *
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br.br>
 * @link https://github.com/fgsl/geneticalgorithm for the canonical source repository
 * @copyright Copyright (c) 2019 FGSL (http://www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE
 */
declare(strict_types = 1);
namespace Fgsl\Test\GeneticAlgorithm;

use Fgsl\GeneticAlgorithm\RulesInterface;

/**
 * 
 */
class KnapsackProblemRules implements RulesInterface
{
    private bool $verbose = false;
    private int $minLimit;
    private int $maxLimit;
    public int $nvalues = 5;

    public function __construct(int $minLimit, int $maxLimit, $verbose = false)
    {
        $this->minLimit = $minLimit;
        $this->maxLimit = $maxLimit;
        $this->verbose  = $verbose;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Fgsl\GeneticAlgorithm\RulesInterface::getBestIndividual()
     */
    public function getBestIndividual(array $individual)
    {
        $bestIndividual = null;
        if (($enough = $this->fitness($individual)) < $this->maxLimit
         && ($enough > $this->minLimit)) {
            $bestIndividual = $individual;
        }
        return $bestIndividual;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Fgsl\GeneticAlgorithm\RulesInterface::fitness()
     */
    public function fitness(array $x): float
    {
        $W = $x[0] * 12 + $x[1] * 1 + $x[2] * 4 + $x[3] * 1 + $x[4] * 2;
        if ($this->verbose) {
            echo "\nWeight summatory:\n";
            echo "$x[0]* 12 + $x[1] * 1 + $x[2] * 4 + $x[3] * 1 + $x[4] * 2 = $W\n";
        }
        $V = $x[0] * 4 + $x[1] * 2 + $x[2] * 10 + $x[3] * 1 + $x[4] * 2;
        if ($this->verbose) {
            echo "\nValue summatory:\n";
            echo "$x[0]* 4 + $x[1] * 2 + $x[2] * 10 + $x[3] * 1 + $x[4] * 2 = $V\n";
        }
        return $W;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Fgsl\GeneticAlgorithm\RulesInterface::crossover()
     */
    public function crossover(array $population): array
    {
        $newIndividual = array_fill(0, $this->nvalues, 0);
        for ($i = 0; $i < $this->nvalues; $i ++) {
            $newIndividual[$i] = (int) (($population[$i][0] + end($population[$i])) / 2);
        }
        return $newIndividual;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Fgsl\GeneticAlgorithm\RulesInterface::showIndividual()
     */
    public function showIndividual(array $individual): string
    {
        $x = $individual;
        return "x[0] = $x[0],x[1] = $x[1], x[2] = $x[2], x[3] = $x[3], x[4] = $x[4]";
    }

    /**
     *
     * {@inheritdoc}
     * @see \Fgsl\GeneticAlgorithm\RulesInterface::randomValue()
     */
    public function randomValue(): int
    {
        return (int) (random_int(0, 3));
    }
}