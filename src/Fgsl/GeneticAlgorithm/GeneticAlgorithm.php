<?php
/**
 * Fgsl Genetic Algorithm
 *
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br.br>
 * @link https://github.com/fgsl/geneticalgorithm for the canonical source repository
 * @copyright Copyright (c) 2019-2025 FGSL (http://www.fgsl.eti.br): array
 * @license https://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE
 */
declare(strict_types = 1);
namespace Fgsl\GeneticAlgorithm;

class GeneticAlgorithm
{
    protected int $populationSize = 0;
    protected ?RulesInterface $rules = null;
    protected int $maxIterations = 0;
    protected bool $verbose = false;

    public function __construct(int $populationSize, RulesInterface $rules, int $maxIterations, bool $verbose = false)
    {
        $this->populationSize = $populationSize;
        $this->rules = $rules;
        $this->maxIterations = $maxIterations;
        $this->verbose = $verbose;
    }

    /**
     *
     * @return NULL|array
     */
    public function execute()
    {
        // start randomly population
        $population = array_fill(0, $this->populationSize, 0);
        array_walk($population, function (&$value, $key) {
            $value = $this->newIndividual();
        });
        for ($i = 1; $i <= $this->maxIterations; $i ++) {
            if ($this->verbose) {
                echo "Iteration {$i} \n";
                echo 'Population: ' . print_r($population, true) . "\n";
            }
            $newPopulation = [];
            array_walk($population, function ($individual, $key) use ($newPopulation) {
                $this->searchForBestIndividual($individual);
                $newPopulation[] = $individual;
            });
            if (empty($newPopulation)) {
                array_walk($population, function (&$value, $key) {
                    $value = $this->newIndividual();
                });
            }
            while (count($newPopulation) < $this->populationSize) {
                $newPopulation[] = $this->crossover($population);
            }
            array_walk($newPopulation, function (&$value, $index) {
                $value = $this->mutation($value);
            });
            $population = $newPopulation;
        }
        $bestIndividual = null;
        foreach ($population as $individual) {
            $bestIndividual = $this->searchForBestIndividual($individual);
        }
        if ($bestIndividual == null && $this->verbose) {
            echo "It couldn't get a satisfatory result\n";
        }
        return $bestIndividual;
    }

    /**
     *
     * @param array $individual
     * @return array|NULL
     */
    protected function mutation(array $individual): array
    {
        if (rand(0, 10) % 2 == 0) {
            $individual = $this->newIndividual();
        }
        return $individual;
    }

    protected function crossover(array $population): array
    {
        return $this->rules->crossover($population, $this->rules->nvalues);
    }

    protected function newIndividual(): array
    {
        $individual = [];
        for ($i = 0; $i < $this->rules->nvalues; $i ++) {
            $individual[$i] = $this->rules->randomValue();
        }
        return $individual;
    }

    protected function searchForBestIndividual(array $individual)
    {
        $bestIndividual = $this->rules->getBestIndividual($individual);
        if ($bestIndividual !== null && $this->verbose) {
            echo "\n" . str_repeat('=', 80);
            echo "\nBest solution: " . $this->rules->showIndividual($bestIndividual) . "\n";
            echo "\n" . str_repeat('=', 80) . "\n";
        }
        return $bestIndividual;
    }
}