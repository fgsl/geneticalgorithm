<?php
/**
 * Fgsl Genetic Algorithm
 *
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br.br>
 * @link https://github.com/fgsl/geneticalgorithm for the canonical source repository
 * @copyright Copyright (c) 2019 FGSL (http://www.fgsl.eti.br)
 * @license https://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE
 */
namespace Fgsl\Test\GeneticAlgorithm;
use PHPUnit\Framework\TestCase;
use Fgsl\GeneticAlgorithm\GeneticAlgorithm;

/**
 *  test case.
 */
class GeneticAlgorithmTest extends TestCase
{
    public function testGeneticAlgorithm()
    {
        $geneticAlgorithm = new GeneticAlgorithm( 100, new BinPackingRules(10,20,true), 1000 );
        $bestIndividual = $geneticAlgorithm->execute ();
        $this->assertTrue(is_array($bestIndividual));
    }    
}