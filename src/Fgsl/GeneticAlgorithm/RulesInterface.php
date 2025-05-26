<?php
/**
 * Fgsl Genetic Algorithm
 *
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br.br>
 * @link https://github.com/fgsl/geneticalgorithm for the canonical source repository
 * @copyright Copyright (c) 2019-2025 FGSL (http://www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE
 */
declare(strict_types=1);
namespace Fgsl\GeneticAlgorithm;

interface RulesInterface
{
    // IMPORTANT: class must implement an attribute public nvalues, for attributes of an individual;
    public function getBestIndividual(array $individual);
    public function fitness(array $x): float;
    public function crossover(array $population): array;
    public function showIndividual(array $individual): string;
    public function randomValue(): int;
}