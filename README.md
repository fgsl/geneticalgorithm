# Fgsl Genetic Algorithm

## How to use:

Create a class that implements `Fgsl\GeneticAlgorithm\RulesInterface`. This class must define fitness function and other constraints.

Inject an instance of rules class in an intance of `Fgsl\GeneticAlgorithm\GeneticAlgorithm` and call method `execute`.

You can see processing details enabling verbose parameter in class constructor.